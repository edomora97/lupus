<?php

/* 
 * Edoardo Morassutto
 * Copyright 2013
 * Vietato l'utilizzo senza il consenso dell'autore
 */

?>

<h2>La partita è iniziata</h2>

<?php
if (isset($status["fine"])) {
    switch ($status["fine"]) {
        case "lupi":
            echo "<h2>Ed è anche finita! I lupi hanno vinto!</h2>";
            break;
        case "buoni":
            echo "<h2>Ed è anche finita! I buoni hanno vinto!</h2>";
            break;
        case "criceto":
            echo "<h2>Ed è anche finita! Il criceto mannaro ha vinto!</h2>";
            break;
        default:
            echo "<h2>E' terminata in modo errato</h2>";
    }
}

?>

<table>
    <thead>
        <tr>
            <th>Utente</th>
            <th>Ruolo</th>
            <th>Morto</th>
            <th>Assassino</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $utenti = query("SELECT * FROM ruoli WHERE gameNum=$gameNum");
            while ($utente = $utenti->fetch_array()) {
                $morto = "No";
                if ($utente["morto"] < 0)
                    $morto = "Notte " . -$utente["morto"];
                if ($utente["morto"] > 0)
                    $morto = "Giorno " . $utente["morto"];
                
                echo "<tr>";
                echo "<td>{$utente['username']}</td>";
                echo "<td>{$utente['ruolo']}</td>";
                echo "<td>$morto</td>";
                echo "<td>{$utente['assassino']}</td>";
                echo "</tr>";
            }
        ?>
    </tbody>
</table>

<hr>