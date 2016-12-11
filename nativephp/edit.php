<?php 
//function to check date
function validate_Date($mydate,$format = 'YYYY/MM/DD') {

    if ($format == 'YYYY/MM/DD') list($year, $month, $day) = explode('/', $mydate);

    if (is_numeric($year) && is_numeric($month) && is_numeric($day))
        return checkdate($month,$day,$year);
    return false;           
} 

	///check input fields first if javascript is disabled
	//check if form is submitted
	if(isset($_POST['editemployee'])){
		$id = intval($_GET['id']);
		//get form inputs
		$name = $_POST['name'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$telephone = $_POST['telephone'];
		$salary = $_POST['salary'];
		$birthDate = $_POST['birthDate'];
		$hireDate = $_POST['hireDate'];
		//check if fields are empty
		if(empty($name) || empty($email) || empty($address) || empty($telephone) || empty($salary) || empty($birthDate) || empty($hireDate)){
			echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please fill in all fields .");
		}
		//check valid email
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please enter a valid email .");
		}
		//check valid telephone
		if(!preg_match("/^022\d{7}$/", $telephone) or !strpos($telephone, '022') === 0){
			echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please enter a valid phone starting with 022 .");
		}
		//check valid salary
		if(!is_numeric($salary) or $salary == 0 or $salary < 0){
			echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please enter a valid salary .");
		}
		//check valid birth date
		if (!validate_Date($birthDate,'YYYY/MM/DD')) {
		    echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please enter a valid date .");
		}
		//check valid hire date
		if (!validate_Date($hireDate,'YYYY/MM/DD')) {
		    echo "<meta http-equiv='refresh' content='3; url=editemployee.php?id=$id'>";
			die("Please enter a valid date .");
		}

		//here all validation is done
		//secure inputs before sending them to database 
		$name = addslashes(strip_tags($_POST['name']));
		$email = addslashes(strip_tags(trim($_POST['email'])));
		$address = addslashes(strip_tags($_POST['address']));
		$telephone = addslashes(strip_tags(trim($_POST['telephone'])));
		$salary = addslashes(strip_tags(trim($_POST['salary'])));
		$birthDate = addslashes(strip_tags(trim($_POST['birthDate'])));
		$hireDate = addslashes(strip_tags(trim($_POST['hireDate'])));

		//include connection file 
		include_once('include/config.php');

		//make query 'bind params for security of sql injection'
		$stmt = $con->prepare("UPDATE employess SET 
				name = ? ,
				email = ? ,
				address = ? ,
				telephone = ? ,
				salary = ? ,
				dateOfBirth = ? ,
				dateOfHire = ?
				WHERE id= ?
			");
		$stmt->bind_param("ssssssss",$name,$email,$address,$telephone,$salary,$birthDate,$hireDate,$id);
		if($stmt->execute()){
			echo "<h1>Updating employee data is done .</h1>";
			echo '<meta http-equiv="refresh" content="3; url=index.php">';
		}

		$stmt->close();
		$con->close();
		//end if isset post submit
	}
?>