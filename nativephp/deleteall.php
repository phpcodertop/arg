<?php 
//include connection file 
	include_once('include/config.php');
	$query = "truncate table employess"; //truncate table data , you can use delete * from employess instead
		if($result = $con->query($query)){
			echo "<h1>Deleting all  employees  is done .</h1>";
			echo '<meta http-equiv="refresh" content="3; url=index.php">';
		}
?>