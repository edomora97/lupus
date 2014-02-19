<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if (!isset($_GET["sessionID"]))
    return;

require_once __DIR__ . "/initialize.php";

$sessionID = mysqli_escape_string($database, $_GET["sessionID"]);
$username = query("SELECT * FROM sessioni WHERE sessionID='$sessionID'");
if ($username->num_rows <> 1)
    return;
$username = $username->fetch_array();
$username = $username["username"];

$ruolo = getRuolo($username);

$query = "SELECT * FROM chat WHERE gameNum=$gameNum AND (utente='$username' OR destinatario='**' OR destinatario='@$username'";
if ($ruolo <> -1 || isSu($username))
    $query .= " OR destinatario='*'";
if ($ruolo == 'Lupo' || isSu($username))
    $query .= " OR destinatario='##L'";
if ($ruolo == 'Massone' || isSu($username))
    $query .= " OR destinatario='##M'";

$messaggi = query($query . ")");
while ($mex = $messaggi->fetch_array()) {
    $mittente = formMittente($mex["utente"]);
    $dest = formDestinatario($mex["destinatario"]);
    $testo = formTesto($mex["testo"]);
    echo "$mittente$dest - $testo\n";
}

function formMittente($mittente) {
    $mittente = str_replace("root", "ADMIN", $mittente);
    if (isSu($mittente))
        $mittente = "$mittente*";
    return "[$mittente]";
}
function formDestinatario($dest) {
    $dest = str_replace("root", "ADMIN", $dest);
    if (isSu(substr($dest,1)))
        $dest = "$dest*";
    if ($dest == '**' || $dest == '*')
        return $dest;
    if ($dest == '##L')
        return "L";
    if ($dest == '##M')
        return "M";
    return ">" . substr($dest, 1);
}

function formTesto($testo) {    
    $testo = str_replace("root", "ADMIN", $testo);
    return $testo;
}