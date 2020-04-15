var prg = document.getElementById("progessbar");

var x = document.getElementById("progessvalue").value;
if(x>=0&&x<=20){
    prg.style.background = "#C00600";
    prg.style.width = x +"%";
    document.getElementById("progess_info").innerHTML = x +" %";
}
else if(x>20&&x<=40) {
    prg.style.background= "#C07700";
    prg.style.width = x +"%";
    document.getElementById("progess_info").innerHTML = x +" %";
}
else if (x>40&&x<=60){
    prg.style.background= "#8EA603";
    prg.style.width = x +"%";
    document.getElementById("progess_info").innerHTML = x +" %";
}
else if(x>60&&x<=80){
    prg.style.background= "#10AB00";
    prg.style.width = x +"%";
    document.getElementById("progess_info").innerHTML = x +" %";
}
else{
    prg.style.background= "#0A8AD1";
    prg.style.width = x +"%";
    document.getElementById("progess_info").innerHTML = x +" %";
}
