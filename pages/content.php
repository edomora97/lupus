<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($username == -1) {  // se non è connesso
    include __DIR__ . "/login.php";
} else {
    if (isSu($username))
        echo "<h1><a href='admin.php'>Sei l'amministratore</a></h1>";
    if ($status["playing"] == false)
        include __DIR__ . "/../ruoli/InAttesa.php";
    else if (isset($status["fine"])) { // se la partita è finita
        include __DIR__ . "/../ruoli/fine/" . $status["fine"] . ".php";
        include __DIR__ . "/../ruoli/fine/fine.php";
    }
    else {
        if (getRuolo($username) == -1)  // se è uno spettatore
            include __DIR__ . "/../ruoli/Spettatore.php";
        else {                // se è un giocatore
            $ruolo = getRuolo($username);
            $user = getUser($username);
            if ($user["morto"] <> 0)
                include __DIR__ . "/../ruoli/Morto.php";
            else
                include __DIR__ . "/../ruoli/$ruolo.php";
        }
        include __DIR__ . "/statoPartita.php";
    }
}