<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;

class SignoutController
{
    public function __construct(private AuthenticationService $authenticationService) {}

    public function __invoke()
    {
        $this->authenticationService->logOut();
    }
}
