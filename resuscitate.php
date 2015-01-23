<?php

require __DIR__.'/_header.php';

/** @var \Doctrine\ORM\EntityManager $em */
$em = require __DIR__ . '/bootstrap.php';

$trainerRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Trainer');
$myTrainer = $trainerRepository->find($_SESSION['id']);

$pokemonRepository = $em->getRepository('ValouuR\PokemonBattle\Model\Pokemon');
/** @var \ValouuR\PokemonBattle\Model\Pokemon $myPokemon */
$myPokemon = $pokemonRepository->findOneBy([
    'trainer' => $myTrainer,
]);

const REZ_COOLDOWN = 24;
$attackError = null;

$lastResuscitate = $myPokemon->getLastResuscitate();

$lastResuscitateInterval = $lastResuscitate->diff(new DateTime()); //Calculates difference between the two dates

$intervalTotalDays = $lastResuscitateInterval->days; //Calculates total number of days between the two dates
$intervalHours = $lastResuscitateInterval->h; //Calculates number of hours between the two dates (after removing total number of days)
$intervalMinutes = $lastResuscitateInterval->i; //Calculates number of hours minutes the two dates (after removing total number of days and hours)
$intervalSeconds = $lastResuscitateInterval->s; //Calculates number of seconds between the two dates (after removing total number of days, hours and seconds)

$totalHourNumber = $intervalTotalDays * 24 + $intervalHours; //Calculates total number of hours for the interval
$totalSecondsNumber = $totalHourNumber * 3600 + $intervalMinutes * 60 + $intervalSeconds; //Calculates total number of seconds for the interval

if($totalSecondsNumber > REZ_COOLDOWN * 3600) {
    $myPokemon
        ->setHP(100)
        ->setLastResuscitate(new DateTime())
    ;

    $em->flush();

    header('Location: my-pokemon.php');
} else {
    $attackError = ('Votre Pokemon ne peut ressusciter qu\'une seule fois par jour.');
}

echo $twig ->render('my-pokemon.html.twig', [
    'attack_error' => $attackError,
]);