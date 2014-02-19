<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

require_once __DIR__ . "/initialize.php";

if (isset($_POST["voto"])) {
    $username = $_SESSION["username"];
    $voto = $_POST["voto"];
    query("INSERT INTO votazioni (utente,voto,gameNum,tempo) VALUES ('$username','$voto',$gameNum,$tempo)");
}
if (isset($_POST["login"])) {
    if (!tryLogin($_POST["username"], $_POST["password"]))
        $loginFail = true;
    else 
        $loginFail = false;
}
if (isset($_POST["logout"])) 
    logout();
if (isset($_POST["sndChat"])) 
    include __DIR__ . "/sendMessage.php";

