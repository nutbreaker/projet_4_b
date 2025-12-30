<?php

namespace tomtroc\controllers;

use tomtroc\models\Book;
use tomtroc\models\User;
use tomtroc\repositories\BookRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\utils\Files;
use tomtroc\utils\Utils;

class AddBookController
{

    private string $title = 'Tom Troc - Ajouter un livre';

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private UserRepository $userRepository,
        private BookRepository $bookRepository,
    ) {}

    public function __invoke()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['POST', 'GET'])) {
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
            return $this->get();
        }

        $this->post($user);
    }

    public function get(): void
    {
        $this->viewService->view('add_book', [
            'title' => $this->title,
            'isAuthenticated' => $this->authenticationService->isLoggedIn(),
        ]);
    }

    public function post(User $user): void
    {
        $errors = [];

        $image = $_FILES['image'];
        $title = Utils::sanitize($_POST['title']);
        $author = Utils::sanitize($_POST['author']);
        $comment = Utils::sanitize($_POST['comment']);
        $availability = Utils::sanitize($_POST['availability']);
        $isImageAllowed = Files::isAllowed($image);
        $imagePath = null;

        // Validation
        if (Utils::isEmpty($title)) {
            $errors['title'] = "Le titre est requis.";
        }

        if (Utils::isEmpty($author)) {
            $errors['author'] = "L'auteur est requis.";
        }

        if (Utils::isEmpty($comment)) {
            $errors['comment'] = "Le commentaire est requis.";
        }

        if (Utils::isEmpty($availability)) {
            $errors['availability'] = "Le disponibilité est requis.";
        }

        if (!Files::isEmpty($image) && $isImageAllowed) {
            $errors['image'] = "L'image n'est pas valide.";
        }

        if (count($errors) === 0 && !Files::isEmpty($image) && $isImageAllowed) {
            $imagePath = Files::save($image);
        }

        if (count($errors) === 0 && !Files::isEmpty($image) && !$imagePath) {
            $errors['image'] = "Erreur lors de l'enregistrement de l'image.";
        }

        if (!empty($errors)) {
            $this->viewService->view('add_book', [
                'title' => $this->title,
                'bookTitle' => $title,
                'bookAuthor' => $author,
                'bookComment' => $comment,
                'bookAvailability' => boolval($availability),
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'errors' => $errors,
            ]);
            return;
        }

        try {
            $book = new Book();
            $book->setTitle($title)
                ->setAuthor($author)
                ->setDescription($comment)
                ->setImage($imagePath)
                ->setAvailability(boolval($availability))
                ->setUserId($user->getId());

            $this->bookRepository->add($book);
            $errors = [];

            header("Location: //{$_SERVER['HTTP_HOST']}/account");
            die();
        } catch (\Exception $_) {
            $errors['general'] = "Une erreur est survenue lors de l'ajout du livre. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'add_book',
                ['title' => $this->title, 'errors' => $errors],
                500
            );
        }
    }
}
