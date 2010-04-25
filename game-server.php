<?php

require("functions.inc.php");
$db = new DB();
$action = $_GET["action"];

$directions = array("f","b","r","l");
$_SESSION["quantity"]++;

switch($action) {
	case "connectToGame":
		if(!$_SESSION["playerid"]) {
			$db->query("SELECT max(unit) FROM player WHERE gameid='0';");
			
			list($maxunit) = $db->fetchrow();
			if($maxunit != "") {
				$unit = $maxunit + 1;
				//print "maxunit existed, incrementing by 1.";
			} else {
				$unit = 0;
				//print "maxunit was '$maxunit'.";
			}

				

			$db->query("INSERT INTO player (unit) VALUES ('$unit');");
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
		$cmd = $db->escape($_GET["command"]);
		$unit = $_SESSION["unit"];
		$orders = explode(";",$cmd);
		$round = 0;
		foreach($orders as $order) {
			if( list($p,$a,$q) = explode(",",$order)) {
				$db->query("INSERT INTO desired_event (unit, priority, action, quantity, round) VALUES ('$unit','$p', '$a', '$q','$round');");
				$round++;
			}
		}
		print "{}";
		break;
	case "clientQuit":
		$db->query("UPDATE player SET active = 0 WHERE id = '" . $_SESSION["playerid"] . "' LIMIT 1;");
		print "{}";
		break;
		
		
}
