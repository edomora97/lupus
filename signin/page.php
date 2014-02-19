<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<h1>Registrati</h1>
<?php
    //if ($errors <> "")
        echo $errors;
?>
<form action="signin.php" method="post" id="signin">
    <table>
        <tr>
            <td>Username: </td>
            <td><input type="text" name="username" /></td>
        </tr>
        <tr>
            <td>Password: </td>
            <td><input type="password" name="password" /></td>
        </tr>
    </table>    
    <input type="submit" name="signin" value="Registrati" />
</form>