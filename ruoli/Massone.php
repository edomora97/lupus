<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($tempo > 0) {
    if (hasVoted($username))
        include __DIR__ . "/include/giaVotato.php";
    else {
        include __DIR__ . "/votazioni/Diurna.php";
        include __DIR__ . "/include/Massone.php";
    }
} else {
    include __DIR__ . "/include/sleep.php";
}