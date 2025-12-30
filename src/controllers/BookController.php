<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\repositories\BookRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\Utils;

class BookController
{
    private string $title = 'Tom Troc - ';

    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private userRepository $userRepository,
        private BookRepository $bookRepository,
    ) {}

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

    public function get(): void
    {
        try {
            $id = $_GET['id'] ?? null;
            $book = $this->bookRepository->find($id);

            if (!$id || !$book) {
                $this->viewService->view(
                    'error',
                    [
                        'title' => '404 Not Found',
                        'message' => 'Livre non trouvé.',
                    ],
                    404
                );

                return;
            }

            $user = $this->userRepository->find($book->getUserId());

            $this->viewService->view('book', [
                'title' => $this->title . $book->getTitle(),
                'book' => $book,
                'user' => $user,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'isUserMatch' => $user->getId() === $this->sessionService->getValue("id_user"),
                'utils' => Utils::class,
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
}
