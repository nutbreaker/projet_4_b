<?php

namespace tomtroc\controllers;

use tomtroc\services\AuthenticationService;
use tomtroc\services\ViewService;


class SigninController
{
    private ViewService $viewService;
    private string $title = 'Tom Troc - Connexion';
    private AuthenticationService $authenticationService;

    public function __construct(ViewService $viewService, AuthenticationService $authenticationService)
    {
        $this->viewService = $viewService;
        $this->authenticationService = $authenticationService;
    }

    public function get()
    {
        $this->viewService->view('signin', ['title' => $this->title]);
    }

    public function post()
    {
        $errors = [];

        $email = htmlentities($_POST['email'] ?? '');
        $password = htmlentities($_POST['password'] ?? '');

        if (empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse e-mail n'est pas valide.";
        }

        // The specification doesn't mention any requirement for the password
        // https://course.oc-static.com/projects/876_DA_PHP_Sf_V2/P6/PHP+Sf+P6+-+Specifications+fonctionnelles.pdf
        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis.";
        }

        if (!$this->authenticationService->login($email, $password)) {
            $errors['authentication'] = "Adresse e-mail ou mot de passe incorrect.";
        }

        if (!empty($errors)) {
            $this->viewService->view('signin', [
                'title' => $this->title,
                'errors' => $errors,
                'email' => $email
            ]);

            return;
        }
    }

    public function __invoke()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
            http_response_code(405);

            $this->viewService->view('error', [
                'title' => 'Tom Troc - 405 Method Not Allowed',
                'message' => 'Méthode non autorisée',
            ]);

            die();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->get();

            return;
        }

        $this->post();
    }
}
