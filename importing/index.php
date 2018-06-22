<!DOCTYPE html>
<html>
<head>
	<title>Exporting</title>
</head>
<body>
	<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="Import" value="Import">Upload</button>
</form>
<?php 
if(isset($_POST["Import"]))
{
    //First we need to make a connection with the database
    $host='localhost:3306'; // Host Name.
    $db_user='root'; //User Name
    $db_password= '';
    $db= 'export'; // Database Name.
    $conn=mysqli_connect($host,$db_user,$db_password) or die (mysqli_error());
    mysqli_select_db($conn,$db) or die (mysqli_error());
    echo $filename=$_FILES["file"]["tmp_name"];

    if($_FILES["file"]["size"] > 0)
    {	
        $file = fopen($filename, "r");
        $count = 0;
        while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
        {
            $count++;
            print_r($emapData);
            if($count>1){ //set count to which row to start 0-...
            date_default_timezone_set('UTC');
            $timestamp = strtotime($emapData[0]);
            $date=date("Y-m-d", $timestamp);
        	$sql = "INSERT into employee (Emp_Date,Name,Site) values ('$date','$emapData[1]','$emapData[2]')";
            print_r($sql);
       	 	$result = mysqli_query($conn,$sql);
            	if(!$result) {
                	die("<strong>WARNING:</strong><br>" . mysqli_error($conn));
            	}
	        }
        }

        fclose($file);

        echo 'CSV File has been successfully Imported';
    }
    else
        echo 'Invalid File:Please Upload CSV File';
}
?>

</body>
</html>