<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<form action="index.php" method="post" id="login">
    <h1>Accedi</h1>
    <?php 
        if (isset($loginFail) && $loginFail)
            echo "<h3>Login non riuscito</h3>";
    ?>
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username"></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password"></td>
        </tr>
    </table>    
    <input type="submit" name="login" value="Accedi">
</form>
<?php
    if (isset($status["signinEnable"]) && $status["signinEnable"] == true)
        echo "<h3><a href='signin.php'>Registrazioni abilitate</a></h3>";