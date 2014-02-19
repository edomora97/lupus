<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

echo "<div id='ruolo'>";
$ruolo = getRuolo($username);
if ($ruolo <> -1) {
    echo "<h1>Il tuo ruolo è</h1>";
    echo "<p>$ruolo</p>";
} else 
    echo "<h1>Sei uno spettatore</h1>";

echo "</div>";