<?php

spl_autoload_register(function ($className) {
    $folders = [
        'src/controllers/',
        'src/models/',
        'src/repositories/',
        'src/services/',
        'src/utils/',
    ];

    foreach ($folders as $folder) {
        $className = str_replace("\\", "/", $className);
        [,, $cleanClass] = explode('/', $className);
        
        if (file_exists('../' . $folder . $cleanClass . '.php')) {
            @require_once '../' . $folder . $cleanClass . '.php';
        }
    }
});
