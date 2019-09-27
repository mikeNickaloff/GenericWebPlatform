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
	function __construct()
	{
		$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
		
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
		$stmt = "create table if not exists ".$tableName." (id int,";
		$paramCount = 0;
		foreach ($tableParams as $param) {
			$colName = $param[0];
			$colType = $param[1];
			$stmt .= $colName." ".$colType;
			$paramCount++;
			if ($paramCount < sizeof($tableParams)) {
				$stmt .= ", ";	
			} else {
				$stmt .= ");";
			}
		}
	
		$this->execute($stmt);				
	}
	/* $data is array(array("column"=>"mycolumn", "value"=>$myValue), ... ) */
	function insert_multi($table, $data) {
		$columns = array_map('getColumns',$data);
		$values = array_map('getValues', $data);
		$statement = "insert into ".$table."(".implode(",",$columns).") VALUES(".str_repeat("? ,", sizeof($columns) - 1)."?)";
	   $result = $this->execute_query($statement, $values);
	}
/* $parameters is array("val1", "val2", etc..)*/	
	function execute_query($statement, $parameters = array()) {
		$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);		
		if ($stmt = $this->dbConnection->prepare($statement)) {
	  			
	  			$stmt->bind_param(str_repeat('s', sizeof($parameters)), ...$parameters);
	  			
	  	}		
		$stmt->execute();
	  	$result = $stmt->get_result();
	  	return $result;
	}	
	function execute($statement) {
			$this->dbConnection = new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);	
  			$this->dbConnection->query($statement);
			print_r($statement);	

	}	
}
 

?>