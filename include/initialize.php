<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

date_default_timezone_set("Europe/Rome");

require_once __DIR__ . "/status.php";
require_once __DIR__ . "/database.php";

$status = getStatus();
$gameNum = isset($status["gameNum"]) ? $status["gameNum"] : 0;
$tempo = (isset($status["tempo"])) ? $status["tempo"] : 0;

session_start();

include __DIR__ . "/postDataCheck.php";

if (isset($_SESSION["username"])) {
    $username = mysqli_escape_string($database, $_SESSION["username"]);
    $sess = query("SELECT * FROM sessioni WHERE username='$username'");
    if ($sess->num_rows <> 1) {
        $username = -1;
        $sessionID = -1;
    } else {
        $sessionID = $sess->fetch_array();
        $sessionID = $sessionID["sessionID"];
    }
} else {
    $username = -1;
    $sessionID = -1;
}

$status = getStatus();
$tempo = (isset($status["tempo"])) ? $status["tempo"] : 0;

require_once __DIR__ . "/refreshStatus.php";

$status = getStatus();

/*
 *   **** FUNZIONI UTILI ****   
 */

function getRuolo($username) {
    global $gameNum;
    $res = query("SELECT * FROM ruoli WHERE username='$username' AND gameNum=$gameNum");
    if ($res->num_rows <> 1)
        return -1;
    $res = $res->fetch_array();
    return $res["ruolo"];
}
function getUser($username) {
    global $gameNum;
    $user = query("SELECT * FROM ruoli WHERE username='$username' AND gameNum=$gameNum");
    if ($user->num_rows <> 1)
        return -1;
    return $user->fetch_array();
}
function hasVoted($username) {
    global $gameNum;
    global $tempo;
    $voto = query("SELECT * FROM votazioni WHERE utente='$username' AND gameNum=$gameNum AND tempo=$tempo");
    return ($voto->num_rows == 1);
}
function getUtenti($where) {
    global $gameNum;
    $res = query("SELECT * FROM ruoli WHERE $where AND gameNum=$gameNum");
    $users = array();
    while ($user = $res->fetch_array())
        $users[] = $user;
    return $users;
}
function tryLogin($username, $password) {
    global $database;
    $username = mysqli_escape_string($database, $username);
    $password = md5(mysqli_escape_string($database, $password));
    $res = query("SELECT * FROM utenti WHERE BINARY username='$username' AND password='$password'");
    if ($res->num_rows <> 1)
        return false;
    $sessionID = generateSessionID();
    $ip = getIP();
    $data = date("Y-m-d h:i:s");
    query("INSERT INTO sessioni (username,sessionID,ip,dateLogin) VALUES ('$username','$sessionID','$ip','$data') ON DUPLICATE KEY UPDATE username='$username', sessionID='$sessionID', ip='$ip', dateLogin='$data'");
    $_SESSION["username"] = $username;
    $_SESSION["sessionID"] = $sessionID;
    $status = getStatus();
    if (!isSu($username))
        $status["online"][$username] = $username;
    saveStatus($status);
    return true;
}
function generateSessionID() {
    $sessionID = "";
    for ($i = 0; $i < 32; $i++) {
        $num = rand(0, 16);
        $num = dechex($num);
        $sessionID .= $num;
    }
    return $sessionID;
}
function logout() {
    global $username;
    global $sessionID;
    $username = -1;
    $sessionID = -1;
    $_SESSION["username"] = -1;
    $_SESSION["sessionID"] = -1;
}
function isSu($username) {
    $res = query("SELECT * FROM utenti WHERE username='$username'");
    if ($res->num_rows <> 1)
        return 0;
    $res = $res->fetch_array();
    return $res["su"];
}
function getIP()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}