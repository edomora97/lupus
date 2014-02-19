<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$continue = true;

if ($status["playing"] == false)
    return;

include __DIR__ . "/status/checkRefresh.php";
if (!$continue)
    return;

if ($tempo > 0)
    include __DIR__ . "/status/doFineGiorno.php";
else 
    include __DIR__ . "/status/doFineNotte.php";

include __DIR__ . "/status/checkFinish.php";