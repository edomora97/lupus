<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function getStatus() {
    global $domain;
    $file = file_get_contents("./status.json", true);
    return json_decode($file, true);    
}
function saveStatus($status) {
    $file = json_encode($status);
    $handle = fopen(__DIR__ . "/../status.json", "w+");
    fwrite($handle, $file);
    fclose($handle);
}