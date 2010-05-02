<?php
require("functions.inc.php");
$db = new DB();
$action = $_GET["action"];
if($action == "getPending") {
	$data = array();
	$gameid = $_SESSION["gameid"];
	if(processEvents()) {
		
		$db->query("SELECT unit,x,y,rot,round FROM pending_event WHERE gameId='$gameid' ORDER BY round ASC;",true);
		
		while($row = $db->fetchassoc()) {
			$data[(int)$row["round"]][] = $row;
		}
		if($db->size() > 0) {
			$db->query("DELETE FROM pending_event WHERE gameId='$gameid';",true);
			
		}
	}
	
	
	//Data we send should look like: 
	// [[{"unit":"0","x":"4","y":"4","rot":"180"},{"unit":"1","x":"5","y":"4","rot":"180"},{"unit":"2","x":"6","y":"4","rot":"180"}]]
	// This structure breaks down as:
	// Rounds[Round[obj]]

	print json_encode($data);
	debug("Display this data to screen: " . json_encode($data));
	debug(print_r($_SESSION["positions"],true));



} else if ($action == "addPending") {
// Debug only, used to add events into DB.
	$unit = 0;
	$x = $db->escape($_GET["x"]);
	$y = $db->escape($_GET["y"]);
	$rot = $db->escape($_GET["rot"]);
	$db->query("INSERT INTO pending_event (unit, x, y, rot) VALUES ('$unit', '$x', '$y', '$rot');");
	
} else if ($action == "resetEverything") {
	
}

