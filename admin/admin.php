<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if (!isSu($username)) {
    header("Location: index.php");
    return;
}

include __DIR__ . "/page.php";