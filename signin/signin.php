<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($username <> -1 && !isSu($username)) {
    header("Location: index.php");
    return;
}
if ($status["signinEnable"] <> true && !isSu($username)) {
    echo "<h1>Registrazioni disabilitate</h1>";
    return;
}
$errors = "";
include __DIR__ . "/logic.php";
include __DIR__ . "/page.php";