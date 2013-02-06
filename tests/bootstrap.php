<?php

if (!@include __DIR__ . '/../vendor/autoload.php') {
    die("You must set up the project dependencies, run the following commands:
wget http://getcomposer.org/composer.phar
php composer.phar install --dev
");
}

gc_enable();

spl_autoload_register(function($class) {
    $filename = str_replace("_", DIRECTORY_SEPARATOR, $class) . '.php';

    foreach (explode(PATH_SEPARATOR, get_include_path()) as $includePath) {
        if (file_exists($includePath . DIRECTORY_SEPARATOR . $filename)) {
            include_once $filename;
            break;
        }
    }

    return class_exists($class, false);
});

define('ROOT_TESTS', realpath(__DIR__));
