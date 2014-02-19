<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeAssassini() {
    global $gameNum;
    global $tempo;
    $assassini = getUtenti("morto=0 AND ruolo='Assassino'");
    $morti = array();
    foreach ($assassini as $assassino) {
        $assassino = $assassino["username"];
        $voto = query("SELECT * FROM votazioni WHERE utente='$assassino' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $voto = $voto["voto"];
        if ($voto == "(nessuno)")
            continue;
        $morti[] = array("morto" => $voto, "assassino" => $assassino);
    }
    return $morti;
}