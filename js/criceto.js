/* 
 * Lupus In Tabula
 * Created by Edoardo Morassutto <edoardo.morassutto@gmail.com>
 */


function criceto(num,desc) {
    if (desc === 0)
        num++;
    else
        num--;
    if (num < 100)
        desc = 0;
    else if (num > 200)
        desc = 1;
    document.getElementById("container").style.backgroundColor = "rgb(" + num + "," + num + ",255)";
    setTimeout("criceto(" + num + "," + desc + ")", 15);
}
criceto(100,0);