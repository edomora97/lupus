<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($tempo < 0) {
    echo "<h1>Il giornale notturno di oggi</h1>";
    if (isset($status["cronaca"])) {
        $userMorto = $status["cronaca"];
        echo "<h2>Approvata la messa al rogo di $userMorto</h2>";
    } else 
        echo "<h2>Oggi non è successo nulla di importante... tranne che... <b><i>E' APPENA INIZIATA LA PARTITA!!!</i></b></h2>";
} else {
    echo "<h1>Il giornale della mattina</h1>";
    echo "<h3>Un ben svegliati a tutti i vivi!</h3>";
    $morti = isset($status["cronaca"]) ? $status["cronaca"] : array();
    if (count($morti) > 0) {
        echo "<h2>Cronaca nera</h2>";
        echo "<p>Sfortunatamente ";
        echo "<b>" . $morti[0] . "</b>";
        for ($i = 1; $i < count($morti) - 1; $i++)
            echo ", <b>" . $morti[$i] . "</b>";
        if (count($morti) > 1)
            echo " e <b>" . $morti[count($morti)-1] . "</b>";
        if (count($morti) == 1)
            echo " è stato trovato morto</p>";
        else
            echo " sono stati trovati morti</p>";
    } else {
        echo "<p>Questa è stata una notte noiosa... non è morto nessuno</p>";
    }
    $gossip = isset($status["gossip"]) ? $status["gossip"] : array();
    if (count($gossip) > 0) {
        echo "<h2>Gossip</h2>";
        foreach ($gossip as $scoop)
            echo "<p>$scoop</p>";
    }
}