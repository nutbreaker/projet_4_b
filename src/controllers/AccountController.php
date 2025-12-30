<?php

namespace tomtroc\controllers;

use tomtroc\models\User;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\repositories\UserRepository;
use tomtroc\repositories\BookRepository;
use tomtroc\utils\Files;
use tomtroc\utils\Utils;

class AccountController
{
    private string $title = 'Tom Troc - Mon Compte';

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private UserRepository $userRepository,
        private BookRepository $bookRepository
    ) {}



    public function __invoke()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'GET'])) {
            $this->viewService->view('error', [
                'title' => 'Tom Troc - 405 Method Not Allowed',
                'message' => 'Méthode non autorisée',
            ], 405);

            die();
        }

        $this->authenticationService->lock();

        $user = $this->userRepository->find(
            $this->sessionService->getValue("id_user")
        );

        if (!$user) {
            $this->authenticationService->logOut();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $this->get($user);

            return;
        }

        $this->post($user);
    }

    public function get(User $user): void
    {
        $deleteBookId = $_GET['delete_book_id'] ?? null;

        if ($deleteBookId) {
            $this->deleteBook($user, intval($deleteBookId));

            return;
        }

        $books = $this->bookRepository->findAllByUserId($user->getId());

        $this->viewService->view('account', [
            'title' => $this->title,
            'user' => $user,
            'nbBooks' => count($books),
            'books' => $books,
            'utils' => Utils::class,
            'isAuthenticated' => $this->authenticationService->isLoggedIn(),
        ]);
    }

    public function deleteBook(User $user, int $deleteBookId): void
    {
        $bookToDelete = $this->bookRepository->find($deleteBookId);

        if (!$bookToDelete) {
            $this->viewService->view('error', [
                'title' => "404 Not Found",
                'message' => "Livre non trouvé.",
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            ], 404);

            die();
        }

        if ($bookToDelete->getUserId() !== $user->getId()) {
            $this->viewService->view(
                'error',
                [
                    'title' => "403 Forbidden",
                    'message' => "Vous n'êtes pas autorisé à supprimer ce livre.",
                    'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                ],
                403
            );

            die();
        }

        $this->bookRepository->remove($bookToDelete);
        
        if (file_exists($bookToDelete->getImage())) {
            unlink($bookToDelete->getImage());
        }

        header("Location: //{$_SERVER['HTTP_HOST']}/account");
        die();
    }

    public function postUpdateImage(User $user): void
    {
        $errors = [];
        $imagePath = null;
        $isImageAllowed = Files::isAllowed($_FILES['avatar']);

        if (!$isImageAllowed) {
            $errors['avatar'] = "Le format de l'image n'est pas valide.";
        }

        if (count($errors) === 0) {
            $imagePath = Files::save($_FILES['avatar']);
        }

        if (!$imagePath) {
            $errors['image'] = "Erreur lors de l'enregistrement de l'image.";
        }

        if (count($errors) > 0) {
            $this->viewService->view(
                'account',
                [
                    'title' => $this->title,
                    'errors' => $errors,
                    'user' => $user,
                ]
            );

            return;
        }

        try {
            Files::delete($user->getImage());

            $user
                ->setImage($imagePath);

            $this->userRepository->update($user);
            $errors = [];

            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        } catch (\Exception $_) {
            $errors['general'] = "Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'account',
                [
                    'title' => $this->title,
                    'errors' => $errors
                ]
            );
        }
    }

    public function postUpdateInfo(User $user): void
    {
        $errors = [];

        $username = Utils::sanitize($_POST['username']);
        $password = Utils::sanitize($_POST['password']);
        $email = Utils::sanitize($_POST['email']);
        $hasUserName = !Utils::isEmpty($username);
        $hasUserNameChanged = $hasUserName && $username !== $user->getUsername();
        $hasEmail = !Utils::isEmpty($email);
        $hasEmailChanged = $hasEmail && $email !== $user->getEmail();

        if (!$hasUserName) {
            $errors['username'] = "Le pseudo est requis.";
        }

        if (
            $hasUserNameChanged &&
            $this->userRepository->findByUsername($username)
        ) {
            $errors['username'] = "Ce pseudo est déjà utilisé.";
        }

        if (!$hasEmail || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide.";
        }

        if (
            $hasEmailChanged &&
            $this->userRepository->findByEmail($email)
        ) {
            $errors['email'] = "Cette adresse email est déjà utilisée.";
        }

        if (count($errors) > 0) {
            $this->viewService->view(
                'account',
                [
                    'title' => $this->title,
                    'errors' => $errors,
                    'user' => $user,
                ]
            );

            return;
        }

        try {
            $user
                ->setUsername($username)
                ->setEmail($email);

            if (!empty($password)) {
                $user->setPassword(hash("sha256", $password));
            }

            $this->userRepository->update($user);
            $errors = [];

            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        } catch (\Exception $_) {
            $errors['general'] = "Une erreur est survenue lors de la mise à jour. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'account',
                ['title' => $this->title, 'errors' => $errors]
            );
        }
    }

    public function post(User $user): void
    {
        if (!$user) {
            $this->viewService->view('error', [
                'title' => '404 Not Found',
                'message' => 'Utilisateur non trouvé.',
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            ], 404);

            die();
        }

        if (!Files::isEmpty($_FILES['avatar'])) {
            $this->postUpdateImage($user);

            return;
        }

        $this->postUpdateInfo($user);
    }
}
