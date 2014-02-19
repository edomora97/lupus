/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */


function checkRefresh() {
    var data = new Date();
    ora = data.getHours();
    minuti = data.getMinutes();
    secondi = data.getSeconds();
    if (minuti < 10) minuti = "0" + minuti;
    if (secondi < 10) secondi = "0" + secondi;
    console.log("Controllo per aggiornamenti numero " + count + 
            " delle ore " + ora + ":" + minuti + ":" + secondi);
    count++;
    var xmlhttp;
    if (window.XMLHttpRequest) 
        xmlhttp = new XMLHttpRequest();
    else 
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    xmlhttp.onreadystatechange=function() {
        if (xmlhttp.readyState==4 && xmlhttp.status==200) {
            var res = xmlhttp.responseText;
            var status = JSON.parse(res);
            if (status.lastRefresh == undefined)
                status.lastRefresh = 0;
            if (status.lastRefresh > lastRefresh)
                window.location.href=window.location.href;
            else 
                setTimeout("checkRefresh()", 5000);
        } else if (xmlhttp.readyState==4 && xmlhttp.status==0){
            console.error("errore");
            setTimeout("checkRefresh()", 5000);
        }
    };
    xmlhttp.open("GET","status.json",true);
    xmlhttp.send();
}
var count = 1;
setTimeout("checkRefresh()", 5000);