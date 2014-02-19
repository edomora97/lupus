<?php 
    $status = getStatus();
    $numContadini = (!isset($status["ruoli"]["Contadino"])) ? 5 : $status["ruoli"]["Contadino"];
    $numLupi = (!isset($status["ruoli"]["Lupo"])) ? 2 : $status["ruoli"]["Lupo"];
    $numMedium = (!isset($status["ruoli"]["Medium"])) ? 1 : $status["ruoli"]["Medium"];
    $numVeggenti = (!isset($status["ruoli"]["Veggente"])) ? 1 : $status["ruoli"]["Veggente"];
    $numCriceti = (!isset($status["ruoli"]["Criceto"])) ? 1 : $status["ruoli"]["Criceto"];
    $numGuardie = (!isset($status["ruoli"]["Guardia"])) ? 1 : $status["ruoli"]["Guardia"];
    $numPaparazzi = (!isset($status["ruoli"]["Paparazzo"])) ? 1 : $status["ruoli"]["Paparazzo"];
    $massoni = (!isset($status["ruoli"]["Massone"])) ? "off" : $status["ruoli"]["Massone"];
    $numKamikaze = (!isset($status["ruoli"]["Kamikaze"])) ? 1 : $status["ruoli"]["Kamikaze"];
    $numAssassini = (!isset($status["ruoli"]["Assassino"])) ? 1 : $status["ruoli"]["Assassino"];
?>
<div id="adminPage">
    <h1>Admin page</h1>
    <?php
        if ($status["playing"])
            include __DIR__ . "/inPlaying.php";
        else 
            include __DIR__ . "/notInPlaying.php";
    ?>
    <form action="admin.php" method="post">
        <table border='1' style='border-collapse: collapse;'>
            <thead>
                <tr>
                    <th>Ruolo</th>
                    <th>Numero</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Contadini</td>
                    <td><input name="contadini" type="number" min="0" max="20" <?php echo "value='$numContadini'"; ?> /></td>
                </tr>
                <tr>
                    <td>Lupi</td>
                    <td><input name="lupi" type="number" min="1" max="20" <?php echo "value='$numLupi'"; ?> /></td>
                </tr>
                <tr>
                    <td>Medium</td>
                    <td><input name="medium" type="number" min="0" max="20" <?php echo "value='$numMedium'"; ?> /></td>
                </tr>
                <tr>
                    <td>Veggenti</td>
                    <td><input name="veggenti" type="number" min="0" max="20" <?php echo "value='$numVeggenti'"; ?> /></td>
                </tr>
                <tr>
                    <td>Criceti mannari</td>
                    <td><input name="cricetiMannari" type="number" min="0" max="20" <?php echo "value='$numCriceti'"; ?> /></td>
                </tr>
                <tr>
                    <td>Guardie</td>
                    <td><input name="guardie" type="number" min="0" max="20" <?php echo "value='$numGuardie'"; ?> /></td>
                </tr>
                <tr>
                    <td>Paparazzi</td>
                    <td><input name="paparazzi" type="number" min="0" max="20" <?php echo "value='$numPaparazzi'"; ?> /></td>
                </tr>
                <tr>
                    <td>Kamikaze</td>
                    <td><input name="kamikaze" type="number" min="0" max="20" <?php echo "value='$numKamikaze'"; ?> /></td>
                </tr>
                <tr>
                    <td>Assassini</td>
                    <td><input name="assassini" type="number" min="0" max="20" <?php echo "value='$numAssassini'"; ?> /></td>
                </tr>
                <tr>
                    <td>Massoni</td>
                    <td><input name="massoni" type="checkbox" <?php if ($massoni == "on") echo "checked"; ?> /></td>
                </tr>
            </tbody>
        </table>
        <p>Aggiorna (riavvia la partita)</p>
        <input type="submit" value="Invia" name="submit" />
    </form>
    <hr>
    <?php
        $somma = 0;
        foreach ($status["ruoli"] as $ruolo => $num) {
            if ($ruolo == "Massone" && $num == "on")
                $somma += 2;
            else if ($ruolo <> "Massone")
                $somma += $num;
        }
        $users = array();
        if (isset($status["online"]))
            foreach ($status["online"] as $user)
                $users[] = $user;
        $count = count($users);
        if ($somma < $count) {
            echo "<b>TROPPI GIOCATORI!</b><br>";
            echo "<p>La partita deve contenere $somma giocatori. $count giocatori sono connessi</p>";
        }
        else if ($somma > $count) {
            echo "<b>MANCANO GIOCATORI</b><br>";
            echo "<p>La partita deve contenere $somma giocatori. $count giocatori sono connessi</p>";
        }
    ?>
    <table border="1"  style="border-collapse: collapse;">
        <thead>
            <tr>
                <th style="width: 100px;">Campo</th>
                <th>Operazioni</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Utenti</td>
                <td>
                    <form action="admin.php" method="post">
                        <input type="submit" value="Disconnetti tutti" name="logoutAll" />
                        <input type="submit" value="Cancella utenti" name="deleteUsers" />
                    </form>
                    <form action="admin.php" method="post">
                        <select name="username">
                            <?php
                                $users = query("SELECT * FROM utenti WHERE 1;");
                                while ($user = $users->fetch_array()) {
                                    $userN = $user["Username"];
                                    if ($userN <> "root")
                                        echo "<option>$userN</option>";
                                }
                            ?>
                        </select>
                        <input type="submit" value="Promuovi" name="grantSU" />
                        <input type="submit" value="Degrada" name="ungrantSU" />
                        <input type="submit" value="Elimina" name="delete" />
                    </form>
                    <form action="admin.php" method="post">
                        <select name="username">
                            <?php
                                $users = query("SELECT * FROM utenti WHERE 1;");
                                while ($user = $users->fetch_array()) {
                                    $userN = $user["Username"];
                                    if ($username == "root" || $userN <> "root")
                                        echo "<option>$userN</option>";
                                }
                            ?>
                        </select>
                        Password: <input type="password" name="password" />
                        <input type="submit" value="Cambia" name="changePassword" />
                    </form>
                </td>
            </tr>
            <tr>
                <td>Partita</td>
                <td>
                    <form action="admin.php" method="post">
                        <input type="submit" value="Avvia" name="start" />
                        <input type="submit" value="Termina" name="termGame" />
                        <input type="submit" value="Cancella" name="deleteGame" />
                    </form>
                </td>
            </tr>
            <tr>
                <td>Pagine</td>
                <td>
                    <form action="admin.php" method="post">
                        <input type="submit" value="Aggiorna" name="refresh" />
                        <input type="submit" value="Abilita Signin" name="enableSignin" />
                        <input type="submit" value="Blocca Signin" name="disableSignin" />
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
    <hr>
    <form action="admin.php" method="post">
        <h4>Modifica manuale</h4>
        <textarea name="status"><?php echo file_get_contents("status.json"); ?></textarea>
        <p>Modifica manualmente il file "status.json"</p> <input type="submit" value="Modifica" name="manualStatus" />
    </form>

    <script type="text/javascript">
    var timer = 60;
    setTimeout('location.href= \"' + self.location.href + '\"',timer * 1000);
    logTimer();
    function logTimer() {
        console.log("Refresh tra " + timer + " secondi");
        timer-=10;
        if (timer > 0)
            setTimeout("logTimer()", 10000);
    }
    </script>
</div>