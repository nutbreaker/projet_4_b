<?php

namespace tomtroc\controllers;

use tomtroc\models\Book;
use tomtroc\models\User;
use tomtroc\repositories\UserRepository;
use tomtroc\repositories\BookRepository;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\utils\Files;
use tomtroc\utils\Utils;

class EditBookController
{
    private string $title = 'Tom Troc - Modifier un livre';

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private UserRepository $userRepository,
        private BookRepository $bookeRepository,
    ) {}

    public function __invoke(): void
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
            $this->viewService->view(
                'error',
                [
                    'title' => '405 Method Not Allowed',
                    'message' => 'Méthode non autorisée',
                ],
                405
            );

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
        $book_id = $_GET['book_id'] ?? null;

        if (!$book_id || !is_numeric($book_id)) {
            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        }

        $book = $this->bookeRepository->find($book_id);

        if (!$book || $book->getUserId() !== $user->getId()) {
            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        }

        $this->viewService->view('edit', [
            'title' => $this->title,
            'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            'book' => $book,
            'utils' => Utils::class,
        ]);
    }

    public function post(User $user): void
    {
        $book_id = intval($_GET['book_id'] ?? null);

        if (!$book_id) {
            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        }

        $book = $this->bookeRepository->find($book_id);

        if (!$book || $book->getUserId() !== $user->getId()) {
            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        }

        if (!Files::isEmpty($_FILES['edit-book-image'] ?? null)) {
            $this->postUpdateImage($book);

            return;
        }

        $this->postUpdateInfo($book);
    }

    private function postUpdateImage(Book $book): void
    {
        $errors = [];
        $imagePath = null;
        $isImageAllowed = Files::isAllowed($_FILES['edit-book-image']);

        if (!$isImageAllowed) {
            $errors['edit-book-image'] = "Le format de l'image n'est pas valide.";
        }

        if (count($errors) === 0) {
            $imagePath = Files::save($_FILES['edit-book-image']);
        }

        if ($imagePath === false) {
            $errors['image'] = "Erreur lors de l'enregistrement de l'image.";
        }

        if (count($errors) > 0) {
            $this->viewService->view(
                'edit',
                [
                    'title' => $this->title,
                    'book' => $book,
                    'utils' => Utils::class,
                    'errors' => $errors,
                ]
            );

            return;
        }

        try {
            Files::delete($book->getImage());

            $book
                ->setImage($imagePath);

            $this->bookeRepository->update($book);
            $errors = [];

            $this->viewService->view('edit', [
                'title' => $this->title,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'book' => $book,
                'utils' => Utils::class
            ]);
        } catch (\Exception $_) {
            $errors['general'] = "Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'edit',
                [
                    'title' => $this->title,
                    'errors' => $errors
                ]
            );
        }
    }

    public function postUpdateInfo(Book $book)
    {
        $errors = [];

        $title = Utils::sanitize($_POST['title']);
        $author = Utils::sanitize($_POST['author']);
        $comment = Utils::sanitize($_POST['comment']);
        $availability = Utils::sanitize($_POST['availability']);

        if (Utils::isEmpty($title)) {
            $errors['title'] = "Le titre est requis.";
        } else {
            $book->setTitle($title);
        }

        if (Utils::isEmpty($author)) {
            $errors['author'] = "L'auteur est requis.";
        } else {
            $book->setAuthor($author);
        }

        if (Utils::isEmpty($comment)) {
            $errors['comment'] = "Le commentaire est requis.";
        } else {
            $book->setDescription($comment);
        }

        if (Utils::isEmpty($availability)) {
            $errors['availability'] = "La disponibilité est requise.";
        } else {
            $book->setAvailability(boolval($availability));
        }

        if (!empty($errors)) {
            $this->viewService->view('edit', [
                'title' => $this->title,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'book' => $book,
                'utils' => Utils::class,
                'errors' => $errors,
            ]);
            return;
        }

        try {
            $this->bookeRepository->update($book);
            $errors = [];

            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        } catch (\Exception $_) {
            $errors['general'] = "Une erreur est survenue lors de la mise à jour du livre. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'edit',
                [
                    'title' => $this->title,
                    'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                    'book' => $book,
                    'utils' => Utils::class,
                    'errors' => $errors
                ]
            );
        }
    }
}
