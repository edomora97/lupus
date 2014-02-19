<?php

/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

?>

<div id="chat">
    <h1>Chat</h1>
    <textarea id="chatArea" readonly>
<?php echo file_get_contents("./include/getChat.php?sessionID=" . $sessionID);  ?>
    </textarea>
    <form action="index.php" method="post">
        <label><input type="radio" name="dest" value="tutti" checked /><span>Tutti</span></label>
        <?php
            if (getRuolo($username) <> -1 || isSu($username)) {
                echo "<label><input type='radio' name='dest' value='partecipanti' /><span>Giocatori</span></label>";
                if (getRuolo($username) == 'Lupo' || isSu($username))
                    echo "<label><input type='radio' name='dest' value='lupi' /><span>Lupi</span></label>";
                if (getRuolo($username) == 'Massone' || isSu($username))
                    echo "<label><input type='radio' name='dest' value='massoni' /><span>Massoni</span></label>";               
                
            }
        ?>
        <label><input type="radio" name="dest" value="admin" /><span>Admin</span></label>
        <div><label class="nobr"><input type="radio" name="dest" value="utente" /><span>Utente</span></label><input type="text" name="user" /></div>     
        
        <input type="text" name="testo" /><input type="submit" name="sndChat" value="Invia" />
    </form>
</div>
<script type="text/javascript" src="js/refreshChat.js"></script>