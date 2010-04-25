<?php
require("functions.inc.php");
$db = new DB();

$action = $_GET["action"];
if($action == "getPending") {
	processEvents();
	$data = array();	
	$db->query("SELECT unit,x,y,rot FROM pending_event;");
	while($row = $db->fetchassoc()) {
		$data[] = array($row);
	}
	//$data[] = array(array('id'=>'0','x'=>5,'y'=>4,'rot'=>270));
	//$data[] = array(array('id'=>'0','x'=>10,'y'=>8,'rot'=>90));

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

