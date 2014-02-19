<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

if ($username <> -1) {
    echo "<form id='logout' method='post' action='index.php'>";
    echo "<p>Tu sei $username. 
             <input type='hidden' name='logout' value='1' /> 
             <a href='' onclick=\"document.getElementById('logout').submit(); return false;\">Logout</a>
          </form>";
    echo "</p>";
}