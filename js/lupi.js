/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */


function lupi(num,desc) {
    if (desc === 0)
        num++;
    else
        num--;
    if (num < 0)
        desc = 0;
    else if (num > 100)
        desc = 1;
    document.getElementById("container").style.backgroundColor = "rgb(170," + num + "," + num + ")";    
    setTimeout("lupi(" + num + "," + desc + ")", 15);
}
lupi(0,0);