<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($username == -1)
    echo "<h2>Devi fare il login</h2>";
else {
    if ($tempo == 0 || $status["playing"] == false)
        echo "<h2>Partita non iniziata</h2>";
    else if (isset($status["fine"])) 
        echo "<h2>Partita terminata</h2>";
    else if ($tempo > 0) 
        echo "<h2>&Egrave; il giorno $tempo</h2>";
    else
        echo "<h2>&Egrave; la notte " . -$tempo . "</h2>";
}