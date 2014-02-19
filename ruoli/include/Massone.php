<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$massoni = getUtenti("ruolo='Massone' AND username<>'$username'");
if (count($massoni) > 0) {
    echo "<h5>I tuoi compagni massoni vivi sono: </h5>";
    echo "<p>";
    echo $massoni[0]['username'];
    for ($i = 1; $i < count($massoni); $i++)
        echo ", {$massoni[$i]['username']}";
    echo "</p>";
} 