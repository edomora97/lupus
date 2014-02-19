<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$lupi = getUtenti("ruolo='Lupo' AND username<>'$username' AND morto=0");
if (count($lupi) > 0) {
    echo "<h5>I lupi vivi sono:</h5>";
    echo "<p>";
    echo $lupi[0]['username'];
    for ($i = 1; $i < count($lupi); $i++)
        echo ", {$lupi[$i]['username']}";
    echo "</p>";
}
?>

<form method="post" action="index.php">
    <p>Devi votare chi vuoi sbranare</p>
    <select name="voto">
        <?php 
            $utenti = getUtenti("morto=0 AND username<>'$username' AND ruolo<>'Lupo'");
            foreach ($utenti as $utente)
                echo "<option>{$utente['username']}</option>";
        ?>
    </select>
    <input type="submit" name="vota" value="Vota" />
</form>
