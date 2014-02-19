<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeLupi() {
    global $gameNum;
    global $tempo;
    $lupi = getUtenti("morto=0 AND ruolo='Lupo'");
    $numeri = array();
    foreach ($lupi as $lupo) {
        $voto = query("SELECT * FROM votazioni WHERE utente='{$lupo['username']}' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $numeri[$voto["voto"]][] = $lupo["username"];
    }
    $eliminabili = array();
    $maxVoti = 0;
    foreach ($numeri as $user => $votiRicevuti) {
        $numVotiRicevuti = count($votiRicevuti);
        if ($numVotiRicevuti > $maxVoti) {
            $eliminabili = array();
            $maxVoti = $numVotiRicevuti;
        }
        if ($numVotiRicevuti == $maxVoti) 
            $eliminabili[] = $user;            
    }
    $sbranato = $eliminabili[rand(0,count($eliminabili)-1)];
    $lupoAlpha = $lupi[rand(0,count($lupi)-1)]["username"];
    return array("morto" => $sbranato, "assassino" => $lupoAlpha);
}