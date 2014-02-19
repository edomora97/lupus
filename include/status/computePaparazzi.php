<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function computePaparazzi($sbranato, $protetti, $veggVisti, $assassini, $kamikaze) {
    global $status;
    $paparazzi = getUtenti("morto=0 AND ruolo='Paparazzo'");
    foreach ($paparazzi as $paparazzo)
        $status["gossip"][] = computePaparazzo ($paparazzo["username"], $sbranato, $protetti, $veggVisti, $assassini, $kamikaze);    
    saveStatus($status);
}

function computePaparazzo($papar, $sbranato, $protetti, $veggVisti, $assassini, $kamikaze) {
    global $gameNum;
    global $tempo;
    $name = query("SELECT * FROM votazioni WHERE utente='$papar' AND gameNum=$gameNum AND tempo=$tempo")->fetch_array();
    $voto = $voto["voto"];
    $compagnia = array();
    if ($name == $sbranato["morto"])
        $compagnia[] = $sbranato["assassino"];
    foreach ($protetti as $guardia => $protetto)
        if ($name == $protetto)
            $compagnia[] = $guardia;
    foreach ($veggVisti as $veggente => $visto)
        if ($name == $visto)
            $compagnia[] = $veggente;
    foreach ($assassini as $morto)
        if ($name == $morto["morto"])
            $compagnia[] = $morto["assassino"];
    foreach ($kamikaze as $morto)
        if ($name == $morto["morto"])
            $compagnia[] = $morto["assassino"];
    if (count($compagnia) == 0)
        return "$name non ha ricevuto visite questa notte";
    else 
        return "Questa notte $name è stato paparazzato insieme a " . implode (", ", $compagnia);
}