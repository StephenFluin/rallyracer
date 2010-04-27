<?php

require("functions.inc.php");
$db = new DB();
$action = $_GET["action"];

$directions = array("f","b","r","l");
$_SESSION["quantity"]++;

if(!$_SESSION["gameid"]) {
	$db->query("SELECT max(id) FROM game");
	list($_SESSION["gameid"]) = $db->fetchrow();
}
$gameid = $_SESSION["gameid"];

switch($action) {
	case "connectToGame":
		if(!$_SESSION["playerid"]) {
			
			$db->query("SELECT max(unit) FROM player WHERE gameid=($gameid);");
			
			list($maxunit) = $db->fetchrow();
			if($maxunit != "") {
				$unit = $maxunit + 1;
				//print "maxunit existed, incrementing by 1.";
			} else {
				$unit = 0;
				//print "maxunit was '$maxunit'.";
			}

				

			$db->query("INSERT INTO player (gameid, unit) VALUES (($gameid), '$unit');");
			$_SESSION["playerid"] = $db->insertid();
			$_SESSION["unit"] = $unit;
			
		}
		
		print $_SESSION["playerid"] . "," . $_SESSION["unit"];
		break;
	case "startGame":
		$data = array();
		for($i = 0;$i<5;$i++) {
			$data[] = array("priority"=>rand(50,950),"action"=>($directions[rand(0,count($directions)-1)]),"quantity"=>rand(1,2));
		}
		print json_encode($data);
		break;
	case "waitForStartGame":
		print "{}";
		break;
	case "sendCommand":
		$unit = $_SESSION["unit"];
		$cmd = $db->escape($_GET["command"]);
		
		
		$db->query("SELECT count(*) FROM desired_event WHERE unit='$unit' AND gameid=($gameid);");
		list($count) = $db->fetchrow();
		if($count == 0) {
			
		
		
			$orders = explode(";",$cmd);
			$round = 0;
			array_pop($orders);
			foreach($orders as $order) {
				if( list($p,$a,$q) = explode(",",$order)) {
					$db->query("INSERT INTO desired_event (gameid, unit, priority, action, quantity, round) VALUES (($gameid), '$unit','$p', '$a', '$q','$round');");
					$round++;
				}
			}
		}
		print "{}";
		break;
	case "clientQuit":
		$db->query("UPDATE player SET active = 0 WHERE id = '" . $_SESSION["playerid"] . "' LIMIT 1;");
		print "{}";
		break;
		
		
}
