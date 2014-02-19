<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$voti = query("SELECT * FROM votazioni WHERE gameNum=$gameNum AND tempo=$tempo");

$votazioni = array();
while ($voto = $voti->fetch_array()) 
    $votazioni[$voto["voto"]][] = $voto["utente"];
$eliminabili = array();
$maxVoti = 0;
foreach ($votazioni as $user => $votiRicevuti) {
    $numVotiRicevuti = count($votiRicevuti);
    if ($numVotiRicevuti > $maxVoti) {
        $eliminabili = array();
        $maxVoti = $numVotiRicevuti;
    }
    if ($numVotiRicevuti == $maxVoti) 
        $eliminabili[] = $user;            
}
// elimina il giocatore con indice i...
$i = rand(0, count($eliminabili)-1);
$userMorto = $eliminabili[$i];
// uccide $userMorto
query("UPDATE ruoli SET morto=$tempo, assassino='Popolo' WHERE username='$userMorto' AND gameNum=$gameNum");
$status["cronaca"] = $userMorto;

// avanza il giorno
//query("TRUNCATE votazioni");
$status["tempo"] = -$tempo;
$tempo = -$tempo;
$status["lastRefresh"] = time()+1;
saveStatus($status);