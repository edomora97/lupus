<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

require_once __DIR__ . "/users.php";
require_once __DIR__ . "/game.php";
require_once __DIR__ . "/pages.php";

/*
 * Cambia configurazione partita
 */
if (isset($_POST["submit"]) &&
        isset($_POST["contadini"]) &&
        isset($_POST["lupi"]) &&
        isset($_POST["medium"]) &&
        isset($_POST["veggenti"]) &&
        isset($_POST["cricetiMannari"]) &&
        isset($_POST["guardie"]) &&
        isset($_POST["paparazzi"]) && 
        isset($_POST["assassini"]) && 
        isset($_POST["kamikaze"])) {
    $status = getStatus();
    $status["playing"] = false;
    $status["ruoli"] = array(
        "Contadino" => $_POST["contadini"],
        "Lupo" => $_POST["lupi"],
        "Medium" => $_POST["medium"],
        "Veggente" => $_POST["veggenti"],
        "Criceto" => $_POST["cricetiMannari"],
        "Guardia" => $_POST["guardie"],
        "Paparazzo" => $_POST["paparazzi"],
        "Massone" => isset($_POST["massoni"]) ? "on" : "off",
        "Assassino" => $_POST["assassini"],
        "Kamikaze" => $_POST["kamikaze"]);
    saveStatus($status);
}

/*
 * Disconnetti utente
 */
if (isset($_POST["disconnetti"]))
    disconnetti($_POST["disconnetti"]);

/*
 * Sezione Utenti
 */
if (isset($_POST["logoutAll"]))
    logoutAll($status);
if (isset($_POST["deleteUsers"]))
    deleteUsers($status);
if (isset($_POST["grantSU"]))
    grantSU();
if (isset($_POST["ungrantSU"]))
    ungrantSU();
if (isset($_POST["delete"])) 
    delete();
if (isset($_POST["changePassword"]))
    changePassword();

/*
 * Sezione Partita
 */
if (isset($_POST["start"]))
    startGame($status);
if(isset($_POST["termGame"]))
    termGame();
if (isset($_POST["deleteGame"]))
    deleteGame();

/*
 * Sezione Pagine
 */
if (isset($_POST["refresh"]))
    refreshGame($status);
if (isset($_POST["enableSignin"]))
    enableSignin($status);
if (isset($_POST["disableSignin"]))
    disableSignin($status);

/*
 * Modifica manuale
 */
if (isset($_POST["manualStatus"]))
    manualStatus();


if (count($_POST) > 0)
    header("Location: admin.php");