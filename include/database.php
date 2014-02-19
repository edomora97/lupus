<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

$database = new mysqli("localhost", "root", "password", "lupus");
$domain = "http://192.168.10.4";
function query($query) {
    global $database;
    return $database->query($query);
}
