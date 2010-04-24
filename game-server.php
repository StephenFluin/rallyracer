<?php
require("functions.inc.php");

$action = $_GET["action"];
$db = new DB();

switch($action) {
	case "startGame":
		$data = array();
		for($i = 0;$i<6;$i++) {
			
		}
		print json_encode($data);
		break;
}
