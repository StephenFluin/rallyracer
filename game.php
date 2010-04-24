<!DOCTYPE html>
<html>
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
	setPosition(tank[0],3,0,180);
	console.log("tank moved to " + tank[0].style['top'] + " which is " + (document.body.clientHeight / tileY / 2 - pieceSize/2));
}
function setPosition(element, x, y,rot) {
	var gameBoard = document.getElementById('board');
	if(!rot) {
		rot = "0";
	}
	
	element.style['top'] = (h / tileY)*(y) + (h / tileY)/2 - pieceSize/2 + "px";
	element.style['left'] = (w / tileX)*(x)  + (w / tileX)/2 - pieceSize/2 + "px";
	element.style['-webkit-transform'] = "rotate(" + rot + "deg)";
}

function runEventQueue() {
	$.getJSON('event-server.php',function (data) {
		
	});
}
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
<body onload="initalDraw()">
<div id="pane">
<canvas id="board" width="1200" height="800">
You should upgrade to a browser that supports the internet.</canvas>
<img src="images/tank0.png" alt="Tank 0" id="tank0" class="pawn"/>
</div>

</body>
</html>