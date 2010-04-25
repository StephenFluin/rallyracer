<?php
require("functions.inc.php");
$db = new DB();

$action = $_GET["action"];
if($action == "getPending") {
	processEvents();
	$round = array();
	$previousRound = 0;
	$db->query("SELECT unit,x,y,rot,round FROM pending_event ORDER BY round ASC;");
	while($row = $db->fetchassoc()) {
		if($row["round"] != $previousRound) {
			$data[] = $round;
			$round = array();
		}
		$round[] = $row;
	}
	
	if($round) {
		$data[] = $round;
	}
	if($db->size() == 0) {
		$data = array();
	}
	
	
	//Data we send should look like: 
	// [[{"unit":"0","x":"4","y":"4","rot":"180"},{"unit":"1","x":"5","y":"4","rot":"180"},{"unit":"2","x":"6","y":"4","rot":"180"}]]
	// This structure breaks down as:
	// Rounds[Round[obj]]

	print json_encode($data);


	$db->query("TRUNCATE pending_event;");	
} else if ($action == "addPending") {
// Debug only, used to add events into DB.
	$unit = 0;
	$x = $db->escape($_GET["x"]);
	$y = $db->escape($_GET["y"]);
	$rot = $db->escape($_GET["rot"]);
	$db->query("INSERT INTO pending_event (unit, x, y, rot) VALUES ('$unit', '$x', '$y', '$rot');");
	
} else if ($action == "resetEverything") {
	
}

