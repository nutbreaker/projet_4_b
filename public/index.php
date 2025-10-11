<?php
$pathInfo = $_SERVER['PATH_INFO'] ?? '/';

try {
    match ($pathInfo) {
        '/'         => require_once('../views/home.php'),
        '/account'  => require_once('../views/account.php'),
        '/book'     => require_once('../views/book.php'),
        '/books'    => require_once('../views/books.php'),
        '/chat'     => require_once('../views/chat.php'),
        '/edit'     => require_once('../views/edit.php'),
        '/profile'  => require_once('../views/profile.php'),
        '/signin'   => require_once('../views/signin.php'),
        '/signup'   => require_once('../views/signup.php'),

        default     => (http_response_code(404) && print("404 Not Found!")),
    };
} catch (UnhandledMatchError | Exception $e) {
    http_response_code(500);
    print("500 Internal Server Error!");
}
