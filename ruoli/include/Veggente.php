<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if (isset($status["info"][$username])) {
    $visto = $status["info"][$username];
    foreach ($visto as $who => $what) {
        if ($what == "Lupo")
            echo "<p>$who è un lupo</p>";
        else
            echo "<p>$who non è un lupo</p>";
    }
}