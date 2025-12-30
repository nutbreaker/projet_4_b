<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;
use tomtroc\services\ViewService;
use tomtroc\repositories\BookRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\Utils;

class BooksController
{
    private string $title = "Tom Troc - Nos livres à l'échange";

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private UserRepository $userRepository,
        private BookRepository $bookRepository,
    ) {}

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->viewService->view('error', [
                'title' => '405 Method Not Allowed',
                'message' => 'Méthode non autorisée',
            ], 405);

            die();
        }

        $this->get();
    }

    public function get(): void
    {
        $query = $_GET['q'] ?? null;

        try {
            $books = $this->bookRepository->findByTitle($query);

            $this->viewService->view('books', [
                'title' => $this->title,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'books' => $books,
                'userRepository' => $this->userRepository,
                'query' => $query,
                'utils' => Utils::class
            ]);
        } catch (\Exception $e) {
            $this->viewService->view('error', [
                'title' => '500 Internal Server Error',
                'message' => 'Une erreur est survenue lors du traitement de votre requête.',
            ], 500);

            die();
        }
    }
}
