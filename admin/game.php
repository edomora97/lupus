<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function shuffleRuoli($users, $status, $gameNum) {
    $ruoli = array();
    foreach ($status["ruoli"] as $ruolo => $num) {
        if ($ruolo == "Massone" && $num == "on") {
            $ruoli[] = "Massone";
            $ruoli[] = "Massone";
        }
        else if ($ruolo <> "Massone")
            for ($i = 0; $i < $num; $i++)
                $ruoli[] = $ruolo;
    }
    shuffle($ruoli);
    //query("TRUNCATE ruoli;");
    for ($i = 0; $i < count($users); $i++) {
        $user = $users[$i];
        $ruolo = $ruoli[$i];
        query("INSERT INTO ruoli (username,ruolo,gameNum) VALUES ('$user','$ruolo',$gameNum);");
    }
}

function startGame(&$status) {
    $gameNum = $status["gameNum"] + 1;
    $somma = 0;
    foreach ($status["ruoli"] as $ruolo => $num) {
        if ($ruolo == "Massone" && $num == "on")
            $somma += 2;
        else if ($ruolo <> "Massone")
            $somma += $num;
    }
    $users = array();
    if (isset($status["online"]))
        foreach ($status["online"] as $user)
            $users[] = $user;
    $count = count($users);
   
    if ($count == $somma) {
        shuffleRuoli($users, $status, $gameNum);
        
        $newStatus = array();
        $newStatus["playing"] = true;
        $newStatus["tempo"] = -1;
        $newStatus["online"] = $status["online"];
        $newStatus["ruoli"] = $status["ruoli"];
        $newStatus["lastRefresh"] = time();
        $newStatus["gameNum"] = $gameNum;
        print_r($newStatus);
        saveStatus($newStatus);
        $status = $newStatus;
        //query("TRUNCATE chat");
        //query("TRUNCATE votazioni");
        $data = date("d-m-Y");
        $ora = date("H:i:s");
        query("INSERT INTO chat (utente,destinatario,testo,gameNum) VALUES ('ADMIN','**','La partita è iniziata il $data alle $ora!',$gameNum)");
        require_once __DIR__ . "/../include/refreshStatus.php";
    }
}

function deleteGame() {
    $newStatus = array();
    $newStatus["playing"] = false;
    $newStatus["ruoli"] = array(
        "Contadino" => 5,
        "Lupo" => 2,
        "Medium" => 1,
        "Veggente" => 1,
        "Criceto" => 1,
        "Guardia" => 1,
        "Paparazzo" => 1,
        "Massone" => "off",
        "Kamikaze" => 1
    );
    $newStatus["tempo"] = -1;
    $newStatus["lastRefresh"] = time();
    $newStatus["gameNum"] = 0;
    saveStatus($newStatus);
    //query("TRUNCATE ruoli");
}

function termGame() {
    $status = getStatus();
    $newStatus = array();
    $newStatus["playing"] = false;
    $newStatus["tempo"] = -1;
    $newStatus["ruoli"] = $status["ruoli"];
    $newStatus["online"] = isset($status["online"]) ? $status["online"] : array();
    $newStatus["lastRefresh"] = time();
    $newStatus["gameNum"] = $status["gameNum"];
    saveStatus($newStatus);
    //query("TRUNCATE ruoli");
    //query("TRUNCATE chat");
}
function manualStatus() {
    $status = urldecode($_POST["status"]);
    if(get_magic_quotes_gpc())
        $status = stripslashes($status);
    $file = fopen("status.json", "w+");
    fwrite($file, $status);
    fclose($file);
    global $status;
    $status = getStatus();
}