<?php if(isset($_GET['id'])): ?>
<?php 
	//include connection file 
	include_once('include/config.php');
	//filter given id
	$id = intval($_GET['id']);
	if($id == 0){ // if id changed in url 
		die('You are not allowed !');
	}else{
		//get employee data from database
		$query = "DELETE FROM employess WHERE id = '".$id."'";
		if($result = $con->query($query)){
			echo "<h1>Deleting employee  is done .</h1>";
			echo '<meta http-equiv="refresh" content="3; url=index.php">';
		}
		

	}

?>
<?php endif; ?>	