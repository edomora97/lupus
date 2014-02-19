<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$dest = mysqli_escape_string($database, $_POST["dest"]);
$mittente = $_SESSION["username"];
if ($dest == "utente" && !isset($_POST["user"])) {
    echo "<p>Non posso leggerti nella mente... Se scegli di inviare un messaggio ad un untente in particolare, dimmi il nome di quell'utente</p>";
}else {
    $testo = trim(mysqli_escape_string($database, $_POST["testo"]));
    if ($testo == "") 
        echo "<p>Non mi va di disturbare inutilmente...</p>";
    else {
        if ($dest == "utente") {
            $destUtente = mysqli_escape_string($database, $_POST["user"]);
            if (query("SELECT * FROM utenti WHERE username='$destUtente'")->num_rows <> 1 && !isSu($destUtente))
                echo "<p>Non posso inviare messaggi ad un utente che non esiste...</p>";
            else 
                query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','@$destUtente','$testo',$gameNum)");
        } else if ($dest == "tutti") 
            query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','**','$testo',$gameNum)");
        else if ($dest == "admin") 
            query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','@root','$testo',$gameNum)");
        else if ($dest == "partecipanti")
            query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','*','$testo',$gameNum)");
        else if ($dest == "lupi") 
            query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','##L','$testo',$gameNum)");
        else if ($dest == "massoni") 
            query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('$mittente','##M','$testo',$gameNum)");
        $status = getStatus();
        $status["lastChat"] = time();
        saveStatus($status);
    }
}