var montharray = new Array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","Nopember","Desember")
var serverdate = new Date(currenttime)

function padlength(what){
  var output=(what.toString().length==1)? "0"+what : what
return output
}

function displaytime(){
  serverdate.setSeconds(serverdate.getSeconds()+1)
  datestring=serverdate.getDate()+" "+montharray[serverdate.getMonth()]+" "+serverdate.getFullYear()
  timestring=padlength(serverdate.getHours())+":"+padlength(serverdate.getMinutes())+":"+padlength(serverdate.getSeconds())
  document.getElementById("jam-server").innerHTML=datestring+" "+timestring
}

window.onload=function(){
  displaytime()
  setInterval("displaytime()", 1000)
}
