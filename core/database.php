<?php
function getColumns($inpArray) {
	return $inpArray["column"];
}
function getValues($inpArray) {
	return $inpArray["value"];
}
/*connect to the database*/
class Database extends mysqli {
	var $dbHost = '127.0.0.1';
	var $dbUser = 'docwarehouse';
	var $dbPass = 'bleah1569';
	var $dbName = 'datafault_docwarehouse';
	var $dbConnection;
	function __construct() {
		$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
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
			exit;
		} else {
			echo "Connection OK";
		}
	}
	/* $tableParams is an array of [column,type] arrays */
	/* create_table("users", array( array("username", "text"), array("password", "text"), array("lastLogin", "date") ) */
	function create_table($tableName, $tableParams) {
		$stmt = "create table if not exists " . $tableName . " (id int,";
		$paramCount = 0;
		foreach ($tableParams as $param) {
			$colName = $param[0];
			$colType = $param[1];
			$stmt.= $colName . " " . $colType;
			$paramCount++;
			if ($paramCount < sizeof($tableParams)) {
				$stmt.= ", ";
			} else {
				$stmt.= ");";
			}
		}
		$this->execute($stmt);
	}
	/* $data is array(array("column"=>"mycolumn", "value"=>$myValue), ... ) */
	function insert_multi($table, $data) {
		$columns = array_map('getColumns', $data);
		$values = array_map('getValues', $data);
		$statement = "insert into " . $table . "(" . implode(",", $columns) . ") VALUES(" . str_repeat("? ,", sizeof($columns) - 1) . "?)";
		$result = $this->execute_query($statement, $values);
	}
	/*
	$table is `tableName`   or  `tableName inner join table2` 
	$columns is array(col1, col2, col3,etc)
	$conditions is string 'col1 = 5 and col2 = 6'
	
	*/
	function select($table, $columns, $conditions) {
		$statement = "select " . $this->arrayToColumns($columns) . " from " . $table . " " . $conditions;
		print_r($statement);
		$parameters = $this->conditionsToParameters($conditions);
		$rows = $this->execute_query($statement, $parameters);
		return $rows;
	}
	/* $parameters is array("val1", "val2", etc..)*/
	function execute_query($statement, $parameters = array()) {
		$dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		if ($stmt = $dbConnection->prepare($statement)) {
			$rows = array();
			$stmt->bind_param(str_repeat('s', sizeof($parameters)), ...$parameters);
			$stmt->execute();
			$result = $stmt->get_result();
			if ($result === false) {
				return array();
			}
			while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
				$rows[] = $row;
			}
			$stmt->close();
			$dbConnection->close();
			return $rows;
		} else {
			$result = $dbConnection->query($statement);
			$rows = array();
			while ($row = $result->fetch_array(MYSQLI_NUM)) {
				$rows[] = $row;
			}
			mysqli_free_result($result);
			$dbConnection->close();
			return $rows;
		}
	}
	function execute($statement) {
		$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		$result = $this->dbConnection->query($statement);
		return $result;
	}
}
?>