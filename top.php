<html><head>
<head>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="//vk.com/js/api/openapi.js?136"></script>

<script type="text/javascript">
  VK.init({apiId: API_ID, onlyWidgets: true});
</script>

</head>
<script>var snowmax=35

// Set the colors for the snow. Add as many colors as you like
var snowcolor=new Array("#66B8FF","#66B8FF","#66B8FF","#66B8FF","#66B8FF")

// Set the fonts, that create the snowflakes. Add as many fonts as you like
var snowtype=new Array("Times")

// Set the letter that creates your snowflake (recommended: * )
var snowletter="❄"

// Set the speed of sinking (recommended values range from 0.3 to 2)
var sinkspeed=0.7

// Set the maximum-size of your snowflakes
var snowmaxsize=30

// Set the minimal-size of your snowflakes
var snowminsize=8

// Set the snowing-zone
// Set 1 for all-over-snowing, set 2 for left-side-snowing
// Set 3 for center-snowing, set 4 for right-side-snowing
var snowingzone=1

// Do not edit below this line
var snow=new Array()
var marginbottom
var marginright
var timer
var i_snow=0
var x_mv=new Array();
var crds=new Array();
var lftrght=new Array();
var browserinfos=navigator.userAgent
var ie5=document.all&&document.getElementById&&!browserinfos.match(/Opera/)
var ns6=document.getElementById&&!document.all
var opera=browserinfos.match(/Opera/)
var browserok=ie5||ns6||opera

function randommaker(range) {
rand=Math.floor(range*Math.random())
return rand
}

function initsnow() {
if (ie5 || opera) {
marginbottom = document.body.scrollHeight
marginright = document.body.clientWidth-15
}
else if (ns6) {
marginbottom = document.body.scrollHeight
marginright = window.innerWidth-15
}
var snowsizerange=snowmaxsize-snowminsize
for (i=0;i<=snowmax;i++) {
crds[i] = 0;
lftrght[i] = Math.random()*15;
x_mv[i] = 0.03 + Math.random()/10;
snow[i]=document.getElementById("s"+i)
snow[i].style.fontFamily=snowtype[randommaker(snowtype.length)]
snow[i].size=randommaker(snowsizerange)+snowminsize
snow[i].style.fontSize=snow[i].size+'px';
snow[i].style.color=snowcolor[randommaker(snowcolor.length)]
snow[i].style.zIndex=1000
snow[i].sink=sinkspeed*snow[i].size/5
if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
snow[i].posy=randommaker(2*marginbottom-marginbottom-2*snow[i].size)
snow[i].style.left=snow[i].posx+'px';
snow[i].style.top=snow[i].posy+'px';
}
movesnow()
}

function movesnow() {
for (i=0;i<=snowmax;i++) {
crds[i] += x_mv[i];
snow[i].posy+=snow[i].sink
snow[i].style.left=snow[i].posx+lftrght[i]*Math.sin(crds[i])+'px';
snow[i].style.top=snow[i].posy+'px';

if (snow[i].posy>=marginbottom-2*snow[i].size || parseInt(snow[i].style.left)>(marginright-3*lftrght[i])){
if (snowingzone==1) {snow[i].posx=randommaker(marginright-snow[i].size)}
if (snowingzone==2) {snow[i].posx=randommaker(marginright/2-snow[i].size)}
if (snowingzone==3) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/4}
if (snowingzone==4) {snow[i].posx=randommaker(marginright/2-snow[i].size)+marginright/2}
snow[i].posy=0
}
}
var timer=setTimeout("movesnow()",50)
}

for (i=0;i<=snowmax;i++) {
document.write("<span id='s"+i+"' style='position:absolute;top:-"+snowmaxsize+"'>"+snowletter+"</span>")
}
if (browserok) {
window.onload=initsnow
}</script>
<meta http-equiv="Content-Type" content="text/html; charset=<?=$lang['charset']?>">
<title>Minecorp Photohosting</title>
<link rel=stylesheet href="style.css">
</head>
<body text=#000000 bgcolor=#ffffff link=#09496F vlink=#09496F alink=##8BE1FF>
<center><a href="http://mc-ph.96.lt/"><font style="color: black; font-size:14px; font-family:Arial"><img src="logo.png"></font></a></center><font style="color: black; font-size:14px; font-family:Arial"><br>
<table width=100% cellpadding=10 cellspacing=1 border=0 bgcolor=##8BE1FF>
<p><center><font style="color: black"><a href="index.php">Домой</a> ◇ <a href="tools.php">Наш баннер</a> ◇ <a href="http://minecorp.ru/" target="_blank">MineCorp</a> ◇ <a href="http://forum.minecorp.ru/" target="_blank">Форум</a> ◇ <a href="https://vk.com/minecorp_photohosting" target="_blank">Наша группа VK</a> ◇ <a href="https://vk.com/minecorp_server" target="_blank">Группа MineCorp</a> &#9671; <a href="faq.php">FAQ</a></font></center><font style="color: black; font-size:14px; font-family:Arial"><br></p>
<br></p>
</table>
<br>
<div id="vk_comments"></div>
<script type="text/javascript">
VK.Widgets.Comments("vk_comments", {limit: 5, width: "340", attach: "photo,audio,link"});
</script>