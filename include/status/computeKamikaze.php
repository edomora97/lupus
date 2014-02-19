<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeKamikaze() {
    global $gameNum;
    global $tempo;
    $kamikaze = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo='Kamikaze' AND gameNum=$gameNum");
    $morti = array();
    while ($kami = $kamikaze->fetch_array()) {
        $kami = $kami["username"];
        $voto = query("SELECT * FROM votazioni WHERE utente='$kami' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $voto = $voto["voto"];
        $morti[] = array("morto" => $voto, "assassino" => $kami);
        $morti[] = array("morto" => $kami, "assassino" => $kami);
    }
    return $morti;
}