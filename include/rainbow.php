<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($username == -1)
    return;

$fine = isset($status["fine"]) ? $status["fine"] : "no";

if ($fine == "lupi")
    echo "<script type='text/javascript' src='js/lupi.js'></script>";
else if ($fine == "buoni")
    echo "<script type='text/javascript' src='js/buoni.js'></script>";
else if ($fine == "criceto")
    echo "<script type='text/javascript' src='js/criceto.js'></script>";