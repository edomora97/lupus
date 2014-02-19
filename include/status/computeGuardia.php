<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computeGuardie() {
    global $gameNum;
    global $tempo;
    $protetti = array();
    $guardie = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo='Guardia' AND gameNum=$gameNum");
    while ($guardia = $guardie->fetch_array()) {
        $guardia = $guardia["username"];
        $voto = query("SELECT * FROM votazioni WHERE utente='$guardia' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
        $protetti[$guardia] = $voto["voto"];
    }
    return $protetti;
}