<?php 
	class Database {
		const HOST 		= "localhost";
		const USERNAME 	= "root";
		const PASSWORD 	= "";
		const BASE 		= "techrun";
		const EMAIL 	= "mimi_dincheva@abv.bg";
		
		public $conn;

		public function __construct($host = self::HOST, $username = self::USERNAME, $pass = self::PASSWORD, $database = self::BASE) {
			$this->conn = mysqli_connect($host, $username, $pass);
			if (!$this->conn) {
				die("Not connected : " . mysqli_connect_error());
			}

			$dbSelected = mysqli_select_db($this->conn, $database);
			if (!$dbSelected) {
				die ("Can\'t use $database : " . mysqli_select_db_error());
			} 

			mysqli_set_charset($this->conn,"utf8");
		}

		public function sendQuery($query) {
			print $query;
			//mysqli_query($this->conn, $query);
		}

		public function insert($table, $columns, $values) {
			$columns = implode("`,`", $columns);
			$values = implode("','", $values);
			$query = "INSERT INTO `".$table."` (`".$columns."`) VALUES ('".$values."')";
			$this->sendQuery($query);
		}
	}
	//@add delete(), select() and update() functions (think about where clause`/)
?>

