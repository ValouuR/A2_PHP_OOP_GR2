<?php

require __DIR__ . '/vendor/autoload.php';
$config = include __DIR__.'/config/config.php';

Twig_Autoloader::register();

$loader = new Twig_Loader_Filesystem([
    __DIR__ .'/template/',
]);

$twig = new Twig_Environment($loader,[
    // 'cache' => null
]);

session_start();