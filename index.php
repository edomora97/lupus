<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>
<!DOCTYPE html>

<?php 
    require_once __DIR__ . "/include/initialize.php"; 
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>LUPUS IN TABULA!</title>
        <style>
            @import url("css/style.css");
            <?php 
                if ($username == -1 || $status["playing"] == false)
                    echo "@import url('css/default.css');";
                else if ($tempo == -1)
                    echo "@import url('css/notte.css');";
                else if ($tempo < 0)
                    echo "@import url('css/notte2.css');";
                else
                    echo "@import url('css/giorno.css');";
            ?>            
        </style>     
        <script type="text/javascript" src="js/refresh.js"></script>
        <?php
            include __DIR__ . "/include/initScript.php";
        ?>
    </head>
    <body>
        <div id="container">
            <header>
                <div id="utente">
                    <?php
                        include __DIR__ . "/pages/utente.php";
                    ?>
                </div>
                <h1><a href="./">LUPUS</a></h1>
            </header>
            <div id="giorno">
                <?php 
                    include __DIR__ . "/pages/giorno.php";
                ?>
            </div>
            <?php 
                if ($username <> -1 && $status["playing"] == true) {
                    require_once __DIR__ . "/pages/chat.php";
                    include __DIR__ . "/pages/ruolo.php";        
                    include __DIR__ . "/pages/elencoRuoli.php";
                }
            ?>
            <div id="content">
                <?php                
                    include __DIR__ . "/pages/content.php";
                ?>
            </div>
            <div id="status">
                <?php
                    include __DIR__ . "/pages/status.php";
                ?>
            </div>
        </div>
        <footer>
            Edoardo Morassutto
            <p>
                <img style="border:0;width:88px;height:31px"
                    src="http://jigsaw.w3.org/css-validator/images/vcss"
                    alt="CSS Valido!" 
                    title="CSS Valido!"/>
                <img src="http://www.w3.org/html/logo/badge/html5-badge-h-css3-semantics.png" height="31" 
                     alt="HTML5 Powered with CSS3 / Styling, and Semantics" 
                     title="HTML5 Powered with CSS3 / Styling, and Semantics">
            </p>
        </footer>
        <?php
            include __DIR__ . "/include/rainbow.php";
        ?>
    </body>
</html>
