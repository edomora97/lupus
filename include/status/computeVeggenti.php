<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeVeggenti() {
    global $gameNum;
    global $status;
    global $tempo;
    $veggenti = getUtenti("morto=0 AND ruolo='Veggente'");
    $veggVisti = array();
    $morti = array();
    foreach ($veggenti as $vegg) {
        $vegg = $vegg["username"];
        $voto = query("SELECT * FROM votazioni WHERE utente='$vegg' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $voto = $voto["voto"];
        if ($voto == "(nessuno)")
            continue;
        $ruolo = query("SELECT * FROM ruoli WHERE username='$voto' AND gameNum=$gameNum")->fetch_array();
        $ruolo = $ruolo["ruolo"];
        $veggVisti[$vegg] = $voto;
        if ($ruolo == 'Lupo') 
            $status["info"][$vegg] = array($voto => "Lupo");
        else if ($ruolo == 'Criceto')
            $morti[] = array("morto" => $vegg, "assassino" => $voto);
        else
            $status["info"][$vegg] = array($voto => "NonLupo");
    }
    saveStatus($status);
    return array($morti, $veggVisti);
}