<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . '/bootstrap.php';

use ValouuR\PokemonBattle\Model\Pokemon;

$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');
$trainer = $trainerRepository->findAll();
$my_trainer = $trainerRepository->find($_SESSION['id']);

$pokemonRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Pokemon');
$pokemon = $pokemonRepository->findAll();
$my_pokemon = $pokemonRepository->findOneBy([
    'trainer' => $my_trainer,
]);

echo $twig ->render('all-pokemon.html.twig', [
    'pokemon' => $pokemon,
    'my_pokemon' => $my_pokemon,
]);