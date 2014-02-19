<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */


function logoutAll($status) {
    $status["online"] = array();
    saveStatus($status);
}
function deleteUsers($status) {
    query("DELETE FROM utenti WHERE su<>1");
    //query("TRUNCATE ruoli");
    $status = getStatus();
    $status["playing"] = false;
    $status["tempo"] = -1;
    $status["online"] = array();
    saveStatus($status);
    //query("TRUNCATE ruoli");
    //query("TRUNCATE chat");
}
function disconnetti($user) {
    $status = getStatus();
    unset($status["online"][$user]);
    saveStatus($status);
}
function changePassword() {
    global $database;
    $password = md5(mysqli_escape_string($database, $_POST["password"]));
    $username = mysqli_escape_string($database, $_POST["username"]);
    query("UPDATE utenti SET password='$password' WHERE username='$username'");
}
function grantSU() {
    global $database;
    $username = mysqli_escape_string($database, $_POST["username"]);
    query("UPDATE utenti SET su=1 WHERE username='$username'");
}
function ungrantSU() {
    global $database;
    $username = mysqli_escape_string($database, $_POST["username"]);
    if ($username <> "root")    // misura di sicurezza...
        query("UPDATE utenti SET su=0 WHERE username='$username'");
}
function delete() {
    global $database;
    $username = mysqli_escape_string($database, $_POST["username"]);
    query("DELETE FROM utenti WHERE username='$username'");
}