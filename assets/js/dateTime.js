var today = new Date();
var date = 'Ngày ' + today.getDate()+' tháng '+(today.getMonth()+1)+' năm '+today.getFullYear() + ' | ';
document.getElementById("date").innerHTML = date ;

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('realtime').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
  }
  function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
  }
  