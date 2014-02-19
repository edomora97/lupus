/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */

function getChatContent() {
    var xmlhttp;
    if (window.XMLHttpRequest) // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    else // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            var res = xmlhttp.responseText;
            var dom = document.getElementById("chatArea");
            dom.textContent = res;
            dom.scrollTop = dom.scrollHeight;
            console.log("Aggiornamento chat riuscito");
        }
    };
    xmlhttp.open("GET","include/getChat.php?sessionID=" + sessionID,true);
    xmlhttp.send();
}
function checkChat() {        
    var data = new Date();
    ora = data.getHours();
    minuti = data.getMinutes();
    secondi = data.getSeconds();
    if (minuti < 10) minuti = "0" + minuti;
    if (secondi < 10) secondi = "0" + secondi;
    console.log("Controllo per chat numero " + count2 + " delle ore " + ora + ":" + minuti + ":" + secondi);
    count2++;
    var xmlhttpChat;
    if (window.XMLHttpRequest)
        xmlhttpChat = new XMLHttpRequest();
    else
        xmlhttpChat = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttpChat.onreadystatechange = function() {
        if (xmlhttpChat.readyState==4 && xmlhttpChat.status==200) {
            var res = xmlhttpChat.responseText;
            var status = JSON.parse(res);
            if (status.lastChat == undefined)
                status.lastChat = 0;
            if (status.lastChat > lastChat) {
                // aggiorna chat
                console.log("Aggiornamento chat disponibile");
                getChatContent();
                lastChat = status.lastChat;
            }                
            setTimeout("checkChat()", 1000);
        }
    };
    xmlhttpChat.open("GET", "status.json",true);
    xmlhttpChat.send();
}
var count2 = 1;
setTimeout("checkChat()",1000);
var dom = document.getElementById("chatArea");
dom.scrollTop = dom.scrollHeight;