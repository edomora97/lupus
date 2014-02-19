<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>
<h1>La partita è finita</h1>
<h2>Il criceto mannaro ha vinto!</h2>
<h3>Congratulazioni a:</h3>
<?php
    $lupi = getUtenti("ruolo='Criceto'");
    foreach ($lupi as $lupo)
        echo "<p><b>{$lupo['username']}</b></p>";