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

		public function select($table, $columns, $where = []) {
			$columns = implode("`,`", $columns);
			$query = "SELECT `".$columns."` FROM `".$table."` WHERE 1 ".$this->generateWhere($where);
			return $this->sendQuery($query);
		}

		public function selectFunction($table, $column, $function, $where = []) {
			$query = "SELECT ".$function."(`".$column."`) AS `".$function."` FROM `".$table."` WHERE 1 ".$this->generateWhere($where);
			$result = $this->sendQuery($query);
			return is_array($result) ? array_pop($result)[$function] : $result;
		}

		public function insert($table, $values) {
			$columns = implode("`,`", array_keys($values));
			$values = implode("','", $values);
			$query = "INSERT INTO `".$table."` (`".$columns."`) VALUES ('".$values."')";
			$this->sendQuery($query);
		}

		public function update($table, $values, $where) {
			$setValues = '';
			foreach ($values as $column => $value) {
				$setValues .= "`".$column."`='".$value."', ";
			}
			$setValues = substr($setValues, 0 , -2);

			$query = "UPDATE `".$table."` SET ".$setValues." WHERE 1 ".$this->generateWhere($where);
			$this->sendQuery($query);
		}

		public function delete($table, $where) {
			$query = "DELETE FROM `".$table."` WHERE 1 ".$this->generateWhere($where);
			$this->sendQuery($query);
		}

		public function sendQuery($query) {
			$result = mysqli_query($this->conn, $query);
			if (is_object($result)) {
				$data = [];
				while ($row = $result->fetch_assoc()) {
					$data[] = $row;
				}
				return $data;
			}
		}

		private function generateWhere($where) {
			$query = "";
			foreach ($where as $parts) {
				//change separator in case of "IN"
				if (is_array($parts['value'])) {
					$parts['value'] = "(".implode(', ', $parts['value']).")";
				} 
				else {
					$parts['value'] = "'".$parts['value']."'";
				}
				$query .= " AND `".$parts['column']."` ".$parts['compare'].$parts['value'];
			}
			return $query;
		}
	}
?>

