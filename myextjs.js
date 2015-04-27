/**
 * Created by Chang-Yi Wu on 2015/3/19.
 */
var sessiondays = [];
sessiondays[0] = [2,3,4,5,6];
sessiondays[1] = [0,1,2,3,4,5,6];
sessiondays[2] = [0,1,2,3,4,5,6];
sessiondays[3] = [0,1,5,6];
var sessiontimes = [];
sessiontimes[0] = [3,3,3,3,3];
sessiontimes[1] = [3,3,0,0,0,2,2];
sessiontimes[2] = [0,0,2,2,2,4,4];
sessiontimes[3] = [2,2,1,1];
function loadSessionDays() {
    var film = document.getElementById("film");
    var day = document.getElementById("day");
    for(var index=0;index<day.length;index++){
        day.options[index].disabled = true;
    }
    for(var index=0;index<time.length;index++){
        time.options[index].disabled = true;
    }
    for(var index=0;index<sessiondays[film.selectedIndex].length;index++){
        day.options[sessiondays[film.selectedIndex][index]].disabled = false;
    }
    day.options[sessiondays[film.selectedIndex][0]].selected = true;
    loadSessionTimes();
}

function loadSessionTimes() {
    var film = document.getElementById("film");
    var time = document.getElementById("time");
    for(var index=0;index<time.length;index++){
        time.options[index].disabled = true;
    }
    for(var index=0;index<sessiontimes[film.selectedIndex].length;index++){
        time.options[sessiontimes[film.selectedIndex][index]].disabled = false;
    }
    time.options[sessiontimes[film.selectedIndex][0]].selected = true;
    optTotal();
}

function checkRate() { //return 0=flat 1=normal
    var day = document.getElementById("day").selectedIndex;
    var time = document.getElementById("time").selectedIndex;
    if(day==0||day==1||(time = 0 && (day == 2 || day == 3 || day == 4))) {
        return 0;
    }
    else {
        return 1;
    }
}
/*
Price list      |   Mon-Tue Wed-Fri:1PM |   Wed-Fri: not 1PM, Sat-SUN   |
Adult           |   12                  |               18              |
Child           |   10                  |               15              |
Concession      |   8                   |               12              |
F Adult         |   25                  |               30              |
F Child         |   20                  |               25              |
Beanbag         |   20                  |               30              |
Beanbag couple  |                       |                               |
Beanbag kids    |                       |                               |
 */
function optTotal()
{
    var totalprice = document.getElementById('t-price');
    var price = 0;
    totalprice.value = price;
    for(var i=1;i<9;i++){
        var idsubtotal = "st"+ i.toString();
        var idselect = "s"+ i.toString();
        var sl = document.getElementById(idselect);
        var st = document.getElementById(idsubtotal);
        switch(idselect){
            case 's1':
                if(checkRate()==0){
                    price = 12;
                }
                else{
                    price = 18;
                }
                break;
            case 's2':
                if(checkRate()==0){
                    price = 10;
                }
                else{
                    price = 15;
                }
                break;
            case 's3':
                if(checkRate()==0){
                    price = 8;
                }
                else{
                    price = 12;
                }
                break;
            case 's4':
                if(checkRate()==0){
                    price = 25;
                }
                else{
                    price = 30;
                }
                break;
            case 's5':
                if(checkRate()==0){
                    price = 20;
                }
                else{
                    price = 25;
                }
                break;
            case 's6':
            case 's7':
            case 's8':
                if(checkRate()==0){
                    price = 20;
                }
                else{
                    price = 30;
                }
                break;
        }
        st.innerHTML = price * sl.options[sl.selectedIndex].value;
        totalprice.value = parseFloat(totalprice.value) + parseFloat(st.innerHTML);
    }
}