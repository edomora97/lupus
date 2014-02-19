<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<h2>La partita non è iniziata!</h2>
<p>I giocatori connessi sono (premere per disconnettere): </p>
<?php
    if (!isset($status["online"]))
        $status["online"] = array();
    echo "<div id='disconnect'>";
    foreach ($status["online"] as $user)
        echo "<form action='admin.php' method='post'><input type='submit' name='disconnetti' value='$user' /></form>";
    echo "</div>";
    if (count($status["online"]) == 0)
        echo "<i>(nessuno)</i>";
?>
<hr>