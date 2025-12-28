<?php
require_once('../config/autoload.php');

use tomtroc\controllers\SigninController;
use tomtroc\controllers\SignoutController;
use tomtroc\controllers\SignupController;
use tomtroc\repositories\UserRepository;
use tomtroc\services\AuthenticationService;
use tomtroc\services\SessionService;
use tomtroc\services\ViewService;
use tomtroc\utils\Database;

//Database
$database =  Database::getInstance('../database/tomtroc.db');

//Repositories
$userRepository = new UserRepository($database);

//Services
$sessionService = new SessionService("tomtroc_session");
$viewService = new ViewService('templates/', '_base_template');
$authenticationService = new AuthenticationService($sessionService, $userRepository);

//Controllers
$signinController = new SigninController($viewService, $authenticationService);
$signoutController = new SignoutController($authenticationService);
$signupController = new SignupController($viewService, $userRepository);

try {

    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    match ($urlPath) {
        '/signin'   => $signinController(),
        '/signout'  => $signoutController(),
        '/signup'   => $signupController(),
    };
} catch (UnhandledMatchError | Exception $e) {
    error_log($e->getMessage());
}
