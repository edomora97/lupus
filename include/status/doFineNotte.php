<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

require_once __DIR__ . "/computeGuardia.php";
require_once __DIR__ . "/computeLupi.php";
require_once __DIR__ . "/computeVeggenti.php";
require_once __DIR__ . "/computeMedium.php";
require_once __DIR__ . "/computeAssassini.php";
require_once __DIR__ . "/computePaparazzi.php";
require_once __DIR__ . "/computeKamikaze.php";

// cancella il giornale
$status["cronaca"] = array();
$status["gossip"] = array();

$morti = array();

// elabora la guardia
$protetti = computeGuardie();

// elabora lupi
$sbranato = computeLupi();
if (array_search($sbranato["morto"], $protetti) === FALSE)
    $morti[] = $sbranato;

// elabora i veggenti
$veggenti = computeVeggenti();
$morti = array_merge($morti, $veggenti[0]);

// elabora i medium
$medium = computeMedium();
$morti = array_merge($morti, $medium[0]);

// elabora gli assassini
$assassini = computeAssassini();
$morti = array_merge($morti, $assassini);

// elabora i kamikaze
$kamikaze = computeKamikaze();
$morti = array_merge($morti, $kamikaze);

// elabora i paparazzi
computePaparazzi($sbranato, $protetti, $veggenti[1], $assassini, $kamikaze);


// uccide quelli che devono morire
$cronaca = array();
foreach ($morti as $morto) {    
    $assassino = $morto["assassino"];
    $userMorto = $morto["morto"];
    query("UPDATE ruoli SET morto=$tempo, assassino='$assassino' WHERE username='$userMorto' AND gameNum=$gameNum");
    $cronaca[] = $morto["morto"];
}
$status["cronaca"] = array_unique($cronaca);
$status["tempo"] = -$tempo+1;
$tempo = -$tempo+1;
$status["lastRefresh"] = time()+1;
saveStatus($status);
//query("TRUNCATE votazioni");