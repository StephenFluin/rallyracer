<?php
session_start();

$GLOBALS["dbHost"] = "localhost";
$GLOBALS["dbUser"] = "rallyracer";
$GLOBALS["dbPass"] = "racerrally";
$GLOBALS["dbDatabase"] = "rallyracer";

$db = new DB();

/* MySQL DB Wrapper */
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

/* This is run every 1 second does detection of game events that affect the board, or everyone.
*/
function processEvents() {
	$db = new DB();
	$db2 = new DB($db);
	/*
	* We're pretending this is an application and storing the game state in the session of the web client!
	*/
	if(!$_SESSION["positions"]) {
		$_SESSION["positions"] = array();
		$_SESSION["positions"][] = array(11,-90,180);
		
		updatePositions();
	}
	
	
	/*
	* Fetch all of the desired moves from the db (Assume they are valid). If we have received one from every player,
	* then process the desired moves and send them to the game screen via pending event..
	*/
	$pos = $_SESSION["positions"][0];
	$db->query("SELECT priority, action, quantity FROM desired_event;");
	while(list($p,$a,$q) = $db->fetchrow()) {
		for($i = 0;$i < $q;$i++) {
			$xChange = $yChange = $rotChange = 0;
			
			switch($a) {
				case "b":
				case "f":
					// 90 - flips direction of rotation for true math and javascript
					$yChange = -1*sin(deg2rad(90-$pos[2]));
					$xChange = cos(deg2rad(90-$pos[2]));
					
					if($a =="b"){
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
			
			//print "xchange is $xChange, ychange is $yChange, rotChange is $rotChange.<br/>\n";
		}
		
		$db2->query("INSERT INTO pending_event (x,y,rot) VALUES ('$x','$y','$rot');");
	}
	$db->query("DELETE FROM desired_event where gameid=0;");
	$_SESSION["positions"][0] = $pos;
}


function updatePositions() {
	$db = new DB();
	foreach($_SESSION["positions"] as $pos) {
		list($x,$y,$r) = $pos;
		$db->query("INSERT INTO pending_event (x,y,rot) VALUES ('$x','$y','$r');");
	}
}