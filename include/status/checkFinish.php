<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$numLupiVivi = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo='Lupo' AND gameNum=$gameNum");
$numLupiVivi = $numLupiVivi->num_rows;
$numNonLupiVivi = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo<>'Lupo' AND gameNum=$gameNum");
$numNonLupiVivi = $numNonLupiVivi->num_rows;
$numCricetiVivi = query("SELECT * FROM ruoli WHERE morto=0 AND ruolo='Criceto' AND gameNum=$gameNum");
$numCricetiVivi = $numCricetiVivi->num_rows;

if ($numLupiVivi >= $numNonLupiVivi)
    if ($numCricetiVivi == 0) {
        $status["fine"] = "lupi";        
        saveStatus($status);
        $continue = false;
    } else {
        $status["fine"] = "criceto";        
        saveStatus($status);
        $continue = false;
    }
else if ($numLupiVivi == 0) 
    if ($numCricetiVivi == 0) {
        $status["fine"] = "buoni";        
        saveStatus($status);
        $continue = false;
    } else {
        $status["fine"] = "criceto";        
        saveStatus($status);
        $continue = false;
    }
