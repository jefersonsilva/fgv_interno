// The AJAX function...
 
function AJAX(){
try{
xmlHttp=new XMLHttpRequest(); // Firefox, Opera 8.0+, Safari
return xmlHttp;
}
catch (e){
try{
xmlHttp=new ActiveXObject("Msxml2.XMLHTTP"); // Internet Explorer
return xmlHttp;
}
catch (e){
try{
xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
return xmlHttp;
}
catch (e){
alert("Your browser does not support AJAX.");
return false;
}
}
}
}
 
// Timestamp for preventing IE caching the GET request (common function)
 
function fetch_unix_timestamp()
{
 return parseInt(new Date().getTime().toString().substring(0, 10))
}
 
////////////////////////////////
//
// Refreshing the DIV TIMEDIV
//
////////////////////////////////
 
function refreshdiv_timediv(){
 
// Customise those settings
 
var seconds = 5;
var divid = "timediv";
var url = "boo.php";
 
// Create xmlHttp
 
var xmlHttp_one = AJAX();
 
// No cache
 
var timestamp = fetch_unix_timestamp();
var nocacheurl = url+"?t="+timestamp;
 
// The code...
 
xmlHttp_one.onreadystatechange=function(){
if(xmlHttp_one.readyState==4){
document.getElementById(divid).innerHTML=xmlHttp_one.responseText;
setTimeout('refreshdiv_timediv()',seconds*1000);
}
}
xmlHttp_one.open("GET",nocacheurl,true);
xmlHttp_one.send(null);
}
 
// Start the refreshing process
 
window.onload = function startrefresh(){
setTimeout('refreshdiv_timediv()',seconds*1000);
}
 
////////////////////////////////
//
// Refreshing the DIV TIMEINWASHINGTON
//
////////////////////////////////
 
function refreshdiv_timeinwashington(){
 
// Customise those settings
 
var seconds = 8;
var divid = "timeinwashington";
var url = "boo2.php";
 
// Create xmlHttp
 
var xmlHttp_two = AJAX();
 
// No cache
 
var timestamp = fetch_unix_timestamp();
var nocacheurl = url+"?t="+timestamp;
 
// The code...
 
xmlHttp_two.onreadystatechange=function(){
if(xmlHttp_two.readyState==4){
document.getElementById(divid).innerHTML=xmlHttp_two.responseText;
setTimeout('refreshdiv_timeinwashington()',seconds*1000);
}
}
xmlHttp_two.open("GET",nocacheurl,true);
xmlHttp_two.send(null);
}
 
// Start the refreshing process
 
window.onload = function startrefresh(){
setTimeout('refreshdiv_timeinwashington()',seconds*1000);
}
 
////////////////////////////////
//
// Refreshing the DIV OTHERDIV
//
////////////////////////////////
 
function refreshdiv_otherdiv(){
 
// Customise those settings
 
var seconds = 10;
var divid = "otherdiv";
var url = "boo3.php";
 
// Create xmlHttp
 
var xmlHttp_three = AJAX();
 
// No cache
 
var timestamp = fetch_unix_timestamp();
var nocacheurl = url+"?t="+timestamp;
 
// The code...
 
xmlHttp_three.onreadystatechange=function(){
if(xmlHttp_three.readyState==4){
document.getElementById(divid).innerHTML=xmlHttp_three.responseText;
setTimeout('refreshdiv_otherdiv()',seconds*1000);
}
}
xmlHttp_three.open("GET",nocacheurl,true);
xmlHttp_three.send(null);
}
 
// Start the refreshing process
 
var seconds;
window.onload = function startrefresh(){
setTimeout('refreshdiv_otherdiv()',seconds*1000);
}