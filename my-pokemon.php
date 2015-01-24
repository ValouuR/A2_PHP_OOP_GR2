<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . '/bootstrap.php';

$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');
$trainer = $trainerRepository->find($_SESSION['id']);

$pokemonRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Pokemon');

/** @var \ValouuR\PokemonBattle\Model\Pokemon $pokemon */
$pokemon = $pokemonRepository->findOneBy([
    'trainer' => $trainer,
]);

// Handle the ressucitation
$attackError = null;

if(isset($_GET['resuscitate']))
    $attackError = $_GET['resuscitate'];

echo $twig ->render('my-pokemon.html.twig', [
    'pokemon' => $pokemon,
    'attack_error' => $attackError,
]);