<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

require_once __DIR__ . "/../include/initialize.php";

if (isset($_POST["signin"]) && $_POST["username"] <> "" && $_POST["password"] <> "") {
    $username = mysqli_escape_string($database, $_POST["username"]);
    $password  = md5(mysqli_escape_string($database, $_POST["password"]));
    if (query("SELECT * FROM utenti WHERE username='$username'")->num_rows <> 0)
        $errors = "<h2>Utente già esistente</h2>";
    else {
        query("INSERT INTO utenti (username,password) VALUES ('$username','$password')");
        logSignin($username);
        if (!isSu($_SESSION["username"]))
            header("Location: index.php");
        else
            $errors = "<h2>Registrazione di '$username' riuscita</h2>";
    }
}

function logSignin($username) {
    $data = date("d-m-Y H:i:s");
    $ip = getIP();
    $log = "[$data][$ip] - Utente registarto: $username\n";    
    $file = fopen("log.signin.txt", "a+");
    fwrite($file, $log);
    fclose($file);
}