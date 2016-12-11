<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="include/style.css">
		<script type="text/javascript" src="include/jquery-2.1.4.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			//ask the user to confirm if he wants to delete 
			$(".del").click(function(){
				return confirm("Are You want to delete This employee?");
			});
		});
		</script>
</head>
<body>
<!--start content of page -->
<div id="container">
	<div class="header">
		<h1>Home</h1>
	</div>

	<div class="content">
		<div class="links">
			<a class="add" href="addemployee.php">Add new employee</a> <br />

			<?php 
			//here first get data from database
			//include connection file 
			include_once('include/config.php');
			$query = "SELECT * FROM employess";
			$result = $con->query($query);
			$num = $result->num_rows;
			//if there is no rows in database
			if($num == 0){
				die('<h1>No employees in the database</h1>');
			}

			?>
			<br />
			<a class="delall" onclick="return confirm('Are you sure you want to delete all employees?');" href="deleteall.php">Delete all employees</a>
			<br />
			<br />
		</div>
		<div class="table">
			<table class="tbl" width="100%"  >
				<thead>
					<th>Id</th>
					<th>Name</th>
					<th>Email</th>
					<th>Telephone</th>
					<th>Action</th>
				</thead>

				<?php 
				//loop throw data and display rows
					while ($row = $result->fetch_array()) {
						echo "<tr>";
						echo "<td>".$row['id']."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['email']."</td>";
						echo "<td>0".$row['telephone']."</td>";
						echo "<td>";
						echo "<a href='editemployee.php?id=".$row['id']."'>Edit</a> - ";
						echo "<a class='del' href='deleteemployee.php?id=".$row['id']."'>Delete</a>";
						echo "</td>";
						echo "</tr>";
					}
				?>
			</table>
		</div>
	</div>
</div>
<!--//end content of page -->
</body>
</html>