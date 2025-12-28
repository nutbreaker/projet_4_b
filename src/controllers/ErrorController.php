<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;
use tomtroc\services\ViewService;

class ErrorController
{
    public function __construct(
        private ViewService $viewService,
        private AuthenticationService $authenticationService
    ) {}

    public function __invoke(string $title, string $message, int $statusCode)
    {
        $this->viewService->view(
            'error',
            [
                'title' => $title,
                'message' => $message,
                'isAuthenticated' => $this->authenticationService->isLoggedIn(),
            ],
            $statusCode
        );
        die();
    }
}
