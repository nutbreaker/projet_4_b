<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;
use tomtroc\services\ViewService;
use tomtroc\repositories\BookRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\Utils;

class HomeController
{
    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private UserRepository $userRepository,
        private BookRepository $bookRepositoriy,
    ) {}

    public function post(): void
    {
        return;
    }

    public function get(): void
    {
        try {
            $books = $this->bookRepositoriy->findLimited(4);

            $this->viewService->view('home', [
                'title' => 'Accueil',
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'books' => $books,
                'userRepository' => $this->userRepository,
                'utils' => Utils::class
            ]);
        } catch (\Exception $e) {

            $this->viewService->view(
                'error',
                [
                    'title' => '500 Internal Server Error',
                    'message' => 'Une erreur est survenue lors du traitement de votre requête.',
                ],
                500
            );

            die();
        }
    }

    public function __invoke()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
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

        $this->get();
    }
}
