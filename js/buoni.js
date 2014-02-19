/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */


function buoni(num,desc) {
    if (desc === 0)
        num++;
    else
        num--;
    if (num < 100)
        desc = 0;
    else if (num > 200)
        desc = 1;
    document.getElementById("container").style.backgroundColor = "rgb(" + num + ",255," + num + ")";
    setTimeout("buoni(" + num + "," + desc + ")", 15);
}
buoni(100,0);