<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<form method="post" action="index.php">
    <p>Devi scegliere chi vuoi assassinare</p>
    <select name="voto">
        <?php 
            $utenti = getUtenti("morto=0 AND username<>'$username'");
            foreach ($utenti as $utente)
                echo "<option>{$utente['username']}</option>";
        ?>
        <option>(nessuno)</option>
    </select>
    <input type="submit" name="vota" value="Vota" />
</form>