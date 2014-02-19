<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($status["playing"] == false)
    return;

?>

<hr>

<?php 
    include __DIR__ . "/giornale.php";
    echo "<hr>";
    include __DIR__ . "/morti.php";