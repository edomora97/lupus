<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<div id="vivi">
    <h1>I vivi sono</h1>
    <p>
    <?php 
        $vivi = getUtenti("morto=0");
        if (count($vivi) > 0)
            echo $vivi[0]["username"];
        else 
            echo "(nessuno)";
        for ($i = 1; $i < count($vivi); $i++)
            echo ", {$vivi[$i]['username']}";
    ?>
    </p>
</div>
<div id="morti">
    <h1>I morti sono</h1>
    <p>
    <?php 
        $morti = getUtenti("morto<>0");
        if (count($morti) > 0)
            echo $morti[0]["username"];
        else 
            echo "(nessuno)";
        for ($i = 1; $i < count($morti); $i++)
            echo ", {$morti[$i]['username']}";
    ?>
    </p>
</div>