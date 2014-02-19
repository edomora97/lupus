<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<div id="elencoRuoli">
    <table>
        <tr><th>Ruolo</th><th>Numero</th></tr>
        <?php 
            foreach ($status["ruoli"] as $ruolo => $num) {
                if ($num > 0)
                    echo "<tr><td>$ruolo</td><td>$num</td></tr>";
                if ($num == "on")
                    echo "<tr><td>Massone</td><td>2</td></tr>";
            }
        ?>
    </table>
</div>