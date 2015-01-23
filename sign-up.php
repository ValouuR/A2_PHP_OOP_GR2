<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ .'/bootstrap.php';

use ValouuR\PokemonBattle\Model\Trainer;

$trainer = new Trainer();

if (isset($_POST['submit'])) {
    $trainer
        ->setUsername($_POST['username'])
        ->setPassword($_POST['password'])
    ;

    $em->persist($trainer);

    $em->flush();

    header('Location: create-pokemon.php');
}

echo $twig ->render('sign-up.html.twig');