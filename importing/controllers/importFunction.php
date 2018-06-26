<?php include "../models/importModel.php";

	$import = isset ($_REQUEST['Import']) ? $_REQUEST['Import']:NULL;
		
		$importModel = new importModel;

		if($import){
			$filename = $_FILES["file"]["tmp_name"];
			$filesize = $_FILES['file']['size'];
			$file = fopen($filename, "r");

			$import = $importModel->import($file,$filesize);
			if($import){
				echo "Data Successfully Stored";
				fclose($file);
			}else
			echo "Failed to store Data";
		}

?>