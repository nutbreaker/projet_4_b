<?php
require_once('../config/autoload.php');

use tomtroc\controllers\SignupController;
use tomtroc\repositories\UserRepository;
use tomtroc\utils\Database;

//Database
$database =  Database::getInstance('../database/tomtroc.db');

//Repositories
$userRepository = new UserRepository($database);

//Services
$viewService = new ViewService('templates/', '_base_template');

//Controllers
$signupController = new SignupController($viewService, $userRepository);

try {

    $urlPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    match ($urlPath) {
        '/signup'   => $signupController(),
    };
} catch (UnhandledMatchError | Exception $e) {
    error_log($e->getMessage());
}
