<!DOCTYPE html>
<html>
<?php 
require("functions.inc.php");
$_SESSION["positions"] = null;
$db->query("TRUNCATE TABLE player;");
?>
<head>
<title>Rally Racer Web</title>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script>
var tileX = 12;
var tileY = 10;
var pieceSize = 54;
var h, w;

function initialDraw() {
	drawBoard();
	drawPieces();
}
function drawBoard() {
	var gameBoard = document.getElementById('board');
	var context = gameBoard.getContext("2d");
	h = gameBoard.height;
	w = gameBoard.width;
	
	
	
	var tileW = Math.round(w / tileX);
	var tileH = Math.round(h / tileY);
	

	for (var xoffset = tileW;xoffset<w;xoffset+=tileW) {
		context.fillRect(xoffset,0,1,h);
		for (var yoffset = tileH;yoffset<h;yoffset+=tileH) {
			context.fillRect(0,yoffset,w,1);
		}
	}
}
function drawPieces() {
	tank = [];
	tank[0] = document.getElementById("tank0");
	//setPosition(tank[0],3,0,180);
	
}
function setPosition(element, x, y,rot) {
	debug("setposition to " + x + "x" + y + " and " + rot + ".");
	console.log("Settings position of " + element + " to " + x + "x" + y + " and " + rot + ".");
	var gameBoard = document.getElementById('board');
	if(!rot) {
		rot = "0";
	}
	element.xLocation = parseInt(x);
	element.yLocation = parseInt(y);
	element.rotation = parseInt(rot);
	
	element.style['top'] = (h / tileY)*(y) + (h / tileY)/2 - pieceSize/2 + "px";
	element.style['left'] = (w / tileX)*(x)  + (w / tileX)/2 - pieceSize/2 + "px";
	element.style['-webkit-transform'] = "rotate(" + rot + "deg)";
	console.log("tank moved to " + x + "x" + y);
}

function runEventQueue() {
	debug("Event queue running.");
	$.getJSON('event-server.php?action=getPending',runEventQueueInstance);
	
	//runEventQueueInstance([[{id:"tank0",x:5,y:4,rot:270}],[{id:"tank0",x:10,y:8,rot:90}]]);
	
}

/*
Data is an array of arrays of the following:
id = element id
x
y
rot
*/
function runEventQueueInstance(data) {
	if(data && data.length > 0 ) {
		debug("processing event queue with " + data.length + " items.");
		//console.log("Processing from server: ");
		//console.log(data);
	} else {
		if(!data) {
			console.log("inavalid data received from server.");
		}
	}
	
	if(data.length > 0) {
		event = data.shift();
		console.log(event);
		for(var i = 0;i<event.length;i++) {
			var obj = document.getElementById("tank" + event[i].unit);
			setPosition(obj,event[i].x,event[i].y,event[i].rot);
		}
		window.setTimeout(function () {runEventQueueInstance(data)},3000);
			
	} else {
		debug("No data in event queue.");
		window.setTimeout(runEventQueue,1000);
	}
}
function debug(msg) {
	document.getElementById("debug").innerHTML = msg;
}
function addMovement(x,y,rot) {
	var t = document.getElementById("tank0");
	x = t.xLocation += x;
	y = t.yLocation += y;
	rot = t.rotation += rot;
	
	
	
	$.get("event-server.php?action=addPending&x=" +x +"&y=" + y+"&rot=" + rot);
	console.log("AJAX GET sent to: " + "event-server.php?action=addPending&x=" +x +"&y=" + y+"&rot=" + rot);
}
function left() {addMovement(-1);}
function right() {addMovement(1);}
function up() {addMovement(0,-1);}
function down() {addMovement(0,1);}
function clock() {addMovement(0,0,90);}
function counterclock() {addMovement(0,0,-90);}

window.setTimeout(runEventQueue,1000);
</script>

<style>
* {margin:0;padding:0;}
#pane {position:absolute;top:25px;left:25px;}
canvas {border-radius:25px;border:1px solid black;margin:auto auto;}
.pawn {position:absolute;
	-webkit-transition-property: all;
	-webkit-transition-duration: 3s;
	}
body {overflow:hidden;}
</style>
</head>
<body onload="initialDraw()">
<div id="pane">
<canvas id="board" width="1200" height="800">
You should upgrade to a browser that supports the internet.</canvas>
<img src="images/tank0.png" alt="Tank 0" id="tank0" class="pawn"/>
<img src="images/tank1.png" alt="Tank 1" id="tank1" class="pawn"/>
<img src="images/tank2.png" alt="Tank 2" id="tank2" class="pawn"/>
</div>



<div id="debug">Debug Data</div>

</body>
</html>