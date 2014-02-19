<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeMedium() {
    global $gameNum;
    global $status;
    global $tempo;
    $medium = getUtenti("morto=0 AND ruolo='Medium'");
    $mediumVisti = array();
    $morti = array();
    foreach ($medium as $med) {
        $med = $med["username"];
        $voto = query("SELECT * FROM votazioni WHERE utente='$med' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $voto = $voto["voto"];
        if ($voto == "(nessuno)")
            continue;
        $visto = query("SELECT * FROM ruoli WHERE username='$voto' AND gameNum=$gameNum")->fetch_array();
        $visto = $visto["ruolo"];
        $mediumVisti[$med] = $voto;
        if ($visto == 'Lupo') 
            $status["info"][$med] = array($voto => "Lupo");
        else if ($visto == 'Criceto') {
            $morti[] = array("morto" => $med, "assassino" => $voto);
        } else
            $status["info"][$med] = array($voto => "NonLupo");
    }
    saveStatus($status);
    return array($morti, $mediumVisti);
}