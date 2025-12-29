<?php

namespace tomtroc\services;

use tomtroc\repositories\UserRepository;
use tomtroc\services\SessionService;

class AuthenticationService
{
    public function __construct(
        private SessionService $sessionService,
        private UserRepository $userRepository
    ) {}

    public function isLoggedIn(): bool
    {
        return $this->sessionService->getIsConnected();
    }

    public function lock()
    {
        if (!$this->sessionService->getIsConnected()) {
            $this->sessionService->setRequestURI($_SERVER["REQUEST_URI"]);

            header("Location: //{$_SERVER['HTTP_HOST']}/signin");

            die();
        }
    }

    public function logIn(string $email, string $password): bool
    {
        $user = $this->userRepository->findByEmailAndPassword($email, hash("sha256", $password));

        if ($user) {
            $requestUri = $this->sessionService->getRequestURI();

            $this->sessionService
                ->regenerate()
                ->setIsConnected(true)
                ->setValue("id_user", $user->getId());

            header("Location: //{$_SERVER['HTTP_HOST']}/{$requestUri}");
            return true;
        }

        sleep(1);
        return false;
    }

    public function logOut()
    {
        $this->sessionService
            ->destroy()
            ->start();

        header("Location: //{$_SERVER['HTTP_HOST']}");

        die();
    }
}
