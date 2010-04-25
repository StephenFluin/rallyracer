<?php
require("functions.inc.php");
$db = new DB();

$action = $_GET["action"];

$directions = array("f","b","r","l");

switch($action) {
	case "startGame":
		$data = array();
		for($i = 0;$i<5;$i++) {
			$data[] = array("priority"=>rand(50,950),"action"=>($directions[rand(0,count($directions)-1)]),"quantity"=>rand(1,2));
		}
		print json_encode($data);
		break;
	case "sendCommand":
		$cmd = $db->escape($_GET["command"]);
		
		$orders = explode(";",$cmd);
		foreach($orders as $order) {
			list($p,$a,$q) = explode(",",$order);
			$db->query("INSERT INTO desired_event (priority, action, quantity) VALUES ('$p', '$a', '$q');");
		}
		
		
}
