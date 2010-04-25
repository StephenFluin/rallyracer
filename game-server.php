<?php
require("functions.inc.php");
$db = new DB();

$action = $_GET["action"];

$directions = array("f","b","r","l");
$_SESSION["quantity"]++;

switch($action) {
	case "connectToGame":
		if(!$_SESSION["playerid"]) {
			$db->query("SELECT max(unit) FROM player WHERE gameid=0;");
			list($maxunit) = $db->fetchrow();
			if($maxunit == "NULL") {
				$unit = 0;
			} else {
				$unit = $maxunit + 1;
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
	case waitForStartGame:
		print "{}";
		break;
	case "sendCommand":
		$cmd = $db->escape($_GET["command"]);
		
		$orders = explode(";",$cmd);
		foreach($orders as $order) {
			list($p,$a,$q) = explode(",",$order);
			$db->query("INSERT INTO desired_event (priority, action, quantity) VALUES ('$p', '$a', '$q');");
		}
		print "{}";
		break;
	case "clientQuit":
		$db->query("UPDATE player SET active = 0 WHERE id = '" . $_SESSION["playerid"] . "' LIMIT 1;");
		print "{}";
		break;
		
		
}
