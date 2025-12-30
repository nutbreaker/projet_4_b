<?php

namespace tomtroc\controllers;

use tomtroc\services\ViewService;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\repositories\UserRepository;
use tomtroc\repositories\BookRepository;
use tomtroc\utils\Utils;

class ProfileController
{
    private string $title = 'Tom Troc - ';

    public function __construct(

        private ViewService $viewService,
        private AuthenticationService $authenticationService,
        private SessionService $sessionService,
        private UserRepository $userRepository,
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
            $user = $this->userRepository->find($id);

            if (!$user) {
                $this->viewService->view(
                    'error',
                    [
                        'title' => '404 Not Found',
                        'message' => 'Profil utilisateur non trouvé.',
                    ],
                    404
                );
                return;
            }

            $books = $this->bookRepository->findAllByUserId($id);

            $this->viewService->view('profile', [
                'title' => $this->title . $user->getUsername(),
                'books' => $books,
                'user' => $user,
                'utils' => Utils::class,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
                'isUserMatch' => $user->getId() === $this->sessionService->getValue("id_user"),
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
