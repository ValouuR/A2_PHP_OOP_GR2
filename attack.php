<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . '/bootstrap.php';

use ValouuR\PokemonBattle\Model\Pokemon;

$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');
$myTrainer = $trainerRepository->find($_SESSION['id']);

$pokemonRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Pokemon');
/** @var Pokemon $myPokemon */
$myPokemon = $pokemonRepository->findOneBy([
    'trainer' => $myTrainer,
]);

const ATTACK_COOLDOWN = 6;
$attackError = null;

$lastAttack = $myPokemon->getLastAttack();

$lastAttackInterval = $lastAttack->diff(new DateTime()); //Calculates difference between the two dates

$intervalTotalDays = $lastAttackInterval->days; //Calculates total number of days between the two dates
$intervalHours = $lastAttackInterval->h; //Calculates number of hours between the two dates (after removing total number of days)
$intervalMinutes = $lastAttackInterval->i; //Calculates number of hours minutes the two dates (after removing total number of days and hours)
$intervalSeconds = $lastAttackInterval->s; //Calculates number of seconds between the two dates (after removing total number of days, hours and seconds)

$totalHourNumber = $intervalTotalDays*24 + $intervalHours; //Calculates total number of hours for the interval
$totalSecondsNumber = $totalHourNumber * 3600 + $intervalMinutes * 60 + $intervalSeconds; //Calculates total number of seconds for the interval

/** @var Pokemon $hisPokemon */
$hisPokemon = $pokemonRepository->find($_GET['id']);

if($totalSecondsNumber > ATTACK_COOLDOWN * 3600) {
    if ($myPokemon->getType() == Pokemon::TYPE_FIRE && $hisPokemon->getType() == Pokemon::TYPE_PLANT) {
        $hisPokemon->removeHP(rand(15, 30));
        $myPokemon->setLastAttack(new DateTime());
    } elseif ($myPokemon->getType() == Pokemon::TYPE_FIRE && $hisPokemon->getType() == Pokemon::TYPE_WATER) {
        $hisPokemon->removeHP(rand(5, 10));
        $myPokemon->setLastAttack(new DateTime());
    } else {
        $hisPokemon->removeHP(rand(10, 20));
        $myPokemon->setLastAttack(new DateTime());
    }

    $em->flush();
} else {
    $attackError = ('Your Pokemon can only attack once every 6 hours.');
}

echo $twig ->render('attack.html.twig', [
    'my_pokemon'    => $myPokemon,
    'his_pokemon'   => $hisPokemon,
    'attack_error'  => $attackError,
]);