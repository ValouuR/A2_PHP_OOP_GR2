<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . '/bootstrap.php';

/** @var \Doctrine\ORM\EntityRepository $articleRepository */
$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');

use ValouuR\PokemonBattle\Model\Pokemon;

$myPokemon = new Pokemon();

/** @var \ValouuR\PokemonBattle\Model\Trainer $trainer */
$trainer = $trainerRepository->find($_SESSION['id']);

if (isset($_POST['submit'])) {
    $myPokemon
        ->setHP(100)
        ->setName($_POST['name'])
        ->setTrainer($trainer)
        ->setLastAttack(new DateTime("2012-07-08 11:14:15.638276"))
        ->setLastResuscitate(new DateTime("2012-07-08 11:14:15.638276"))
    ;

    if ($_POST['type'] == "fire") {
        $myPokemon
            ->setType(Pokemon::TYPE_FIRE);
    } elseif ($_POST['type'] == "plant") {
        $myPokemon
            ->setType(Pokemon::TYPE_PLANT);
    } else {
        $myPokemon
            ->setType(Pokemon::TYPE_WATER);
    }

    $em->persist($myPokemon);

    $em->flush();

    header('Location: my-pokemon.php');
}

echo $twig ->render('create-pokemon.html.twig');