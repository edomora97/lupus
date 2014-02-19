<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function refreshGame() {
    $status = getStatus();
    $status["lastRefresh"] = time();
    saveStatus($status);
}

function enableSignin() {
    $status = getStatus();
    $status["signinEnable"] = true;
    saveStatus($status);
}

function disableSignin() {
    $status = getStatus();
    $status["signinEnable"] = false;
    saveStatus($status);
}