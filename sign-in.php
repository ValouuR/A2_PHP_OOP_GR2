<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ .'/bootstrap.php';

/** @var \Doctrine\ORM\EntityRepository $trainerRepository */
$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');

if (isset($_POST['sign_in'])) {
    /** @var \ValouuR\PokemonBattle\Model\Trainer $trainerSignIn */
    $trainerSignIn = $trainerRepository->findOneBy([
        'username' => $_POST['username'],
        'password' => $_POST['password']
    ]);

    if ($trainerSignIn !== null) {
        $_SESSION['connect'] = true;
        $_SESSION['id'] = $trainerSignIn->getId();
        header('Location: my-pokemon.php');
    }
}

echo $twig ->render('sign-in.html.twig');