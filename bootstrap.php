<?php

spl_autoload_register(
    function ($class) {
        $require = __DIR__ . '/src/' . str_replace("\\", '/', $class) . '.php';
        $file_exists = file_exists($require);
        if ($file_exists) {
            require_once("$require");
        }
    }
);
