<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function numRuolo($ruolo) {
    global $gameNum;
    $res = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo='$ruolo' AND gameNum=$gameNum");
    return $res->num_rows;
}

if ($tempo < 0) {    
    $numVotanti = numRuolo("Lupo");
    $numVotanti += numRuolo("Medium");
    $numVotanti += numRuolo("Veggente");
    $numVotanti += numRuolo("Guardia");
    $numVotanti += numRuolo("Paparazzo");
    $numVotanti += numRuolo("Kamikaze");
    $numVotanti += numRuolo("Assassino");
} else {
    $numVotanti = query("SELECT * FROM ruoli WHERE morto=0 AND gameNum=$gameNum"); 
    $numVotanti = $numVotanti->num_rows;
}
$numVoti = query("SELECT * FROM votazioni WHERE gameNum=$gameNum AND tempo=$tempo");
$numVoti = $numVoti->num_rows;

if ($numVoti < $numVotanti || $numVotanti == 0)
    $continue = false;
else
    $continue = true;
