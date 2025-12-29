<?php
require_once('../config/autoload.php');

use tomtroc\controllers\AccountController;
use tomtroc\controllers\ErrorController;
use tomtroc\controllers\SigninController;
use tomtroc\controllers\SignoutController;
use tomtroc\controllers\SignupController;
use tomtroc\repositories\BookRepository;
use tomtroc\repositories\UserRepository;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\utils\Database;

//Database
$database =  Database::getInstance('../database/tomtroc.db');

//Repositories
$bookRepository = new BookRepository($database);
$userRepository = new UserRepository($database);

//Services
$sessionService = new SessionService("tomtroc_session");
$viewService = new ViewService('templates/', '_base_template');
$authenticationService = new AuthenticationService($sessionService, $userRepository);

//Controllers
$accountController = new AccountController(
    $viewService,
    $authenticationService,
    $sessionService,
    $userRepository,
    $bookRepository
);
$errorController = new ErrorController($viewService, $authenticationService);
$signinController = new SigninController($viewService, $authenticationService);
$signoutController = new SignoutController($authenticationService);
$signupController = new SignupController($viewService, $userRepository);

try {
    $sessionService->start();

    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    match ($urlPath) {
        '/account'  => $accountController(),
        '/signin'   => $signinController(),
        '/signout'  => $signoutController(),
        '/signup'   => $signupController(),

        default     => $errorController("404 Not Found", "Page non trouvé.", 404),
    };
} catch (UnhandledMatchError | Exception $e) {
    error_log($e->getMessage());

    $errorController(
        "500 Internal Server Error",
        "Une erreur est survenue lors du traitement de votre requête.",
        500
    );
}
