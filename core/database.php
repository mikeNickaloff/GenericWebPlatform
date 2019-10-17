<?php

function getColumns($inpArray) {
	return $inpArray["column"];
}
function getValues($inpArray) {
	return $inpArray["value"];
}
/*connect to the database*/

class Database  {

	var $dbHost;
	var $dbUser;
	var $dbPass;
	var $dbName;
	var $dbPort;
	var $dbConnection;
	function __construct() {
		include_once $_SERVER["DOCUMENT_ROOT"]."/config/database-config.php";
		$this->dbHost = GENWP_DB_HOST;
		$this->dbUser = GENWP_DB_USER;
		$this->dbPass = GENWP_DB_PASS;
		$this->dbName = GENWP_DB_DATABASE;
		$this->dbPort = GENWP_DB_PORT;
		$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName, $this->dbPort);
		$this->test();
	}
	function arrayToColumns($inpArray) {
		$result = "";
		$loopCount = 0;
		foreach ($inpArray as $idx => $colName) {
			$result.= $colName;
			$loopCount++;
			if ($loopCount < sizeof($inpArray)) {
				$result.= ", ";
			} else {
				$result.= "";
			}
		}
		return $result;
	}
	function arrayToConditions($inpArray) {
		$result = "";
		$loopCount = 0;
		foreach ($inpArray as $col => $val) {
			$result.= $col;
			$result.= " = ?";
			$loopCount++;
			if ($loopCount < sizeof($inpArray)) {
				$result.= " and ";
			} else {
			}
		}
		return $result;
	}
	function conditionsToParameters($inpArray) {
		$result = [];
		foreach ($inpArray as $key => $val) {
			$result[] = $val;
		}
		return $result;
	}
	function test() {
		if ($this->dbConnection->connect_errno) {
			echo "Sorry, this website is experiencing problems.";
			echo "Error: Failed to make a MySQL connection, here is why: \n";
			echo "Errno: " . $this->dbConnection->connect_errno . "\n";
			echo "Error: " . $this->dbConnection->connect_error . "\n";
			print_r("Please ensure that the file <b>".$_SERVER["DOCUMENT_ROOT"]."/config/database-config.php</b> exists and is has the correct database information in it");
			exit;
		} else {
			
		}
	}
	/* $tableParams is an array of [column,type] arrays */
	/* create_table("users", array( array("username", "text"), array("password", "text"), array("lastLogin", "date") ) */
	function create_table($tableName, $tableParams) {
		$stmt = "create table if not exists " . $tableName . " (id int auto_increment primary key, ";
		$paramCount = 0;
		$requestedColumns = array();
		foreach ($tableParams as $param) {
			$colName = $param[0];
			$colType = $param[1];
			$requestedColumns[$colName] = $colType;
			$stmt.= $colName . " " . $colType;
			$paramCount++;
			if ($paramCount < sizeof($tableParams)) {
				$stmt.= ", ";
			} else {
				$stmt.= ");";
			}
		}
		$this->execute($stmt);
		
		
		$columns = $this->show_columns($tableName);
		foreach ($requestedColumns as $colName=>$colType) {
			if (!in_array(array_keys($requestedColumns), $columns)) {
					$newstatement = "alter table ".$tableName." add column ".$colName." ".$colType.";";
					$this->execute($newstatement);		
			}	
		}
	}
	
	function show_columns($table) {
		$statement = "show columns from ".$table.";";
		$result = $this->execute_query($statement, array());	
		$rv = array();
		//print_r($result);
		foreach ($result as $row) {
			foreach ($row as $col=>$val) {
				 if ($col == "Field") {
					$rv[] = $val; 	
				}
			}
		}
		return $rv;	
	}
	/* $data is array(array("column"=>"mycolumn", "value"=>$myValue), ... ) */
	function insert_multi($table, $data) {
		$columns = array_map('getColumns', $data);
		$values = array_map('getValues', $data);
		$statement = "insert into " . $table . "(" . implode(",", $columns) . ") VALUES(" . str_repeat("? ,", sizeof($columns) - 1) . "?)";
		//print_r($statement);
		$result = $this->execute_query($statement, $values);
	}
	public function delete($table, $id) {
		//print_r("<br> deleting".$id."<br>");
		$this->execute("delete from $table where id = ".$id);
	}
	function select($table, $columns, $conditions = "", $parameters = array()) {
		$statement = "select " . $this->arrayToColumns($columns) . " from " . $table . " " . $conditions;
		//print_r("select: ".$statement." <br>\n");
		$rows = $this->execute_query($statement, $parameters);
		return $rows;
	}
	/* $parameters is array("val1", "val2", etc..)*/
	function execute_query($statement, $parameters = array()) {
		$dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		$rows = array();
		if (count($parameters) > 0) { 
		if ($stmt = $dbConnection->prepare($statement)) {
			
			$stmt->bind_param(str_repeat('s', sizeof($parameters)), ...$parameters);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result === false) {
				$dbConnection->close();
				return array(array());
			}
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			$stmt->close();
			$dbConnection->close();
			return $rows;
		}
		} else {
			$result = $dbConnection->query($statement);
			
			if ($result === false) {
				$dbConnection->close();
				return array(array());
			}
			$rows = array();
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			mysqli_free_result($result);
			$dbConnection->close();
			return $rows;
		}
	}
	function execute($statement) {
		$dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		$result = $dbConnection->query($statement);
		
		//mysqli_free_result($result);
		$dbConnection->close();
	}
	
}
?>
