<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>
<!DOCTYPE html>

<?php 
    require_once __DIR__ . "/include/initialize.php"; 
    require_once __DIR__ . "/admin/logic.php";
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>ADMIN PAGE</title>
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
            #content {
                padding-right: 0px;
            }
            hr {
                margin-right: 0px;
            }
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
            <div id="content">
                <?php                
                    include __DIR__ . "/admin/admin.php";
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
        </footer>
    </body>
</html>
