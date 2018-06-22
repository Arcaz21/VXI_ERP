<?php include "../models/DBconnection.php"; 
	
	class importModel extends DBConnection{

		// function checkExport(){
		// 	$query = "SELECT * from employee
		// 	WHERE "
		// }

		function import($name,$size){
			if($size > 0){
				$count = 0;
				while (($emapData = fgetcsv($name, 10000, ",")) !== FALSE){
					$count++;
					if($count>1){ //set count to which row to start 0-...
		            date_default_timezone_set('UTC');
		            $timestamp = strtotime($emapData[0]);
		            $date=date("Y-m-d", $timestamp);
		        	$sql = "INSERT into employee (Emp_Date,Name,Site) values ('$date','$emapData[1]','$emapData[2]')";
		            //print_r($sql);
		       	 	$result = mysqli_query($this->conn,$sql);
		            	if(!$result) {
		                	die("<strong>WARNING:</strong><br>" . mysqli_error($this->conn));
		            	}
			        }
				} return TRUE;
			}
		}
	}
?>