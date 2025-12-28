<?php

namespace tomtroc\controllers;

use tomtroc\models\User;
use tomtroc\services\ViewService;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\PostRequest;

class SignupController
{
    private string $title = 'Tom Troc - Inscription';

    public function __construct(private ViewService $viewService, private UserRepository $userRepository)
    { }

    public function get()
    {
        $this->viewService->view('signup', ['title' => $this->title]);
    }

    public function post()
    {
        $errors = [];

        $email = PostRequest::getValue('email');
        $username = PostRequest::getValue('username');
        $password = PostRequest::getValue('password');

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse e-mail n'est pas valide.";
        }

        if (!empty($email) && $this->userRepository->findByEmail($email)) {
            $errors['email'] = "Cette adresse e-mail est déjà utilisée.";
            $email = "";
        }

        if (empty($username)) {
            $errors['username'] = "Le nom d'utilisateur est requis.";
        }

        if (!empty($username) && $this->userRepository->findByUsername($username)) {
            $errors['username'] = "Ce nom d'utilisateur est déjà pris.";
            $username = "";
        }
        // The specification doesn't mention any requirement for the password
        // https://course.oc-static.com/projects/876_DA_PHP_Sf_V2/P6/PHP+Sf+P6+-+Specifications+fonctionnelles.pdf
        if (empty($password)) {
            $errors['password'] = "Le mot de passe est requis.";
        }

        if (count($errors) > 0) {
            $this->viewService->view(
                'signup',
                [
                    'title' => $this->title,
                    'errors' => $errors,
                    'email' => $email,
                    'username' => $username,
                    'password' => $password,
                ]
            );

            return;
        }

        try {
            $user = new User();
            $user
                ->setUsername($username)
                ->setEmail($email)
                ->setPassword(hash("sha256", $password));

            $this->userRepository->add($user);
            $errors = [];

            header("Location: //{$_SERVER['HTTP_HOST']}/signin");
            die();
        } catch (\Exception $e) {
            error_log($e);

            $errors['general'] = "Une erreur est survenue lors de l'inscription. Veuillez réessayer plus tard.";

            $this->viewService->view(
                'signup',
                ['title' => $this->title, 'errors' => $errors],
                500
            );
        }
    }

    public function __invoke()
    {
        if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST'])) {
            $this->viewService->view('error', [
                'title' => '405 Method Not Allowed',
                'message' => 'Méthode non autorisée',
            ], 405);

            die();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $this->get();

            return;
        }

        $this->post();
    }
}
