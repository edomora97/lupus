<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<h1>Mi dispiace ma sei morto...</h1>

<?php 
    $user = getUser($username);
    if ($user["morto"] < 0)
        echo "<h3>Sei morto la notte " . -$user["morto"] . "</h3";
    else
        echo "<h3>Sei morto il giorno " . $user["morto"] . "</h3";