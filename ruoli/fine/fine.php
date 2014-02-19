<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>
<h1>Morti</h1>
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
        $morti = getUtenti("morto<>0");
        foreach ($morti as $morto) {
            if ($morto["morto"] < 0)
                $tempoMorto = "Notte " . -$morto["morto"];
            else 
                $tempoMorto = "Giorno " . $morto["morto"];
            echo "<tr>";
            echo "<td>{$morto['username']}</td>";
            echo "<td>{$morto['ruolo']}</td>";
            echo "<td>$tempoMorto</td>";
            echo "<td>{$morto['assassino']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
<h1>Vivi</h1>
<table>
    <thead>
        <tr>
            <th>Utente</th>
            <th>Ruolo</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $vivi = getUtenti("morto=0");
        foreach ($vivi as $vivo) {
            echo "<tr>";
            echo "<td>{$vivo['username']}</td>";
            echo "<td>{$vivo['ruolo']}</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>