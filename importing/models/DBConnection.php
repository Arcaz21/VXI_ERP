<?php
	
	class DBConnection {
		
		protected $conn;

		function __construct(){
			$dbhost = "localhost:3306";
			$dbuser = 'root';
			$dbpass = "";
			$dbname = "import";

			$this->conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);

			if(!$this->conn) {
				echo "<string> ERROR </strong>".mysql_error($this->conn);
			} else {
				echo "Databse Connected!";
			}
		}

		function runQuery($query){
			$result = mysqli_query($this->conn, $query);

			while($row = mysqli_fetch_assoc($result)){
				$reslutset[] = $row;
			} if (!empty($reslutset)){
				return $reslutset;
			}
		}

		function close(){
			$close = mysqli_close($this->conn);

			if(!$close){
				echo "<string> ERROR </strong>".mysql_error($this->conn);
			} else {
				echo "Databse Successfully Closed!";
			}
		
		}
	}
?>