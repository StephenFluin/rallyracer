<?php
session_start();

$GLOBALS["dbHost"] = "localhost";
$GLOBALS["dbUser"] = "rallyracer";
$GLOBALS["dbPass"] = "racerrally";
$GLOBALS["dbDatabase"] = "rallyracer";

$db = new DB();

class DB {
        var $conn, $quiet;

        function DB($db = null) {
		if($db) {
			$this->conn = $db->conn;
		}
                if(!$conn) {
                        $this->conn = @mysql_connect($GLOBALS["dbHost"], $GLOBALS["dbUser"], $GLOBALS["dbPass"]) or die("Could not connect to the database (" . mysql_error() . ")");
                        @mysql_select_db($GLOBALS["dbDatabase"],$this->conn) or die("Could not select database");
                        // print "DB Connected";
                }
        }

        function query($query = "") {
                $this->results = mysql_query($query,$this->conn );
                if(!$this->results && !$this->quiet) {
                        print "Server Error: (" . mysql_error($this->conn) . ") '$query'.";
                }
                return $this->results;
        }
        function size() {
                return mysql_num_rows($this->results);
        }
        function fetchrow() {
                return mysql_fetch_array( $this->results , MYSQL_NUM );
        }
        function fetchassoc() {
		return mysql_fetch_assoc($this->results);
	}
        function escape($string) {
                return mysql_real_escape_string($string);
        }
}


function processEvents() {
	$db = new DB();
	$db2 = new DB($db);
	/*
	* We're pretending this is an application and storing the game state in the session of the web client!
	*/
	if(!$_SESSION["positions"]) {
		$_SESSION["positions"][] = array(4,4,180);
		updatePositions();
	}
	
	
	$pos = $_SESSION["position"][0];
	$db->query("SELECT (priority, action, quantity) FROM desired_event;");
	while(list($p,$a,$q) = $db->fetchrow()) {
		for($i = 0;$i < $q;$i++) {
			switch($a) {
				case "b":
				case "f":
					$yChange = sin($pos[2]+90);
					$xChange = sin($pos[2]+90);
					if($a=="b") {
						$xChange *= -1;
						$yChange *= -1;
					}
				break;
		
				
				case "r":
					$rotChange = 90;
				break;
				
				case "l":
					$rotChange = -90;
				break;
			}
			$x = $pos[0] += $xChange;
			$y = $pos[1] += $yChange;
			$rot = $pos[2] += $rotChange;
		}
		
		$db2->query("INSERT INTO pending_event (x,y,rot) VALUES ('$x','$y','$rot');");
	}
	$db->query("TRUNCATE desired_event;");
	$_SESSION["positions"] = $pos;
}

function updatePositions() {
	$db = new DB();
	foreach($_SESSION["positions"] as $pos) {
		list($x,$y,$r) = $pos;
		$db->query("INSERT INTO pending_event (x,y,rot) VALUES ('$x','$y','$rot');");
	}
}