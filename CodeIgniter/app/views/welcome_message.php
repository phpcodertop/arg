<?php 
	if($this->session->flashdata('added')){
		echo "<h3 style='text-align:center;'>";
		echo $this->session->flashdata('added');
		echo "</h3>";
	}

	if($this->session->flashdata('edited')){
		echo "<h3 style='text-align:center;'>";
		echo $this->session->flashdata('edited');
		echo "</h3>";
	}

	if($this->session->flashdata('deleted')){
		echo "<h3 style='text-align:center;'>";
		echo $this->session->flashdata('deleted');
		echo "</h3>";
	}

	if($this->session->flashdata('deleteAll')){
		echo "<h3 style='text-align:center;'>";
		echo $this->session->flashdata('deleteAll');
		echo "</h3>";
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/style.css">
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-2.1.4.min.js"></script>
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
			<a class="add" href="add">Add new employee</a> <br />
			<?php 
				if($num == 0){
				die('<h1>No employees in the database</h1>');
			}
			?>
			<br />
			<a class="delall" onclick="return confirm('Are you sure you want to delete all employees?');" href="deleteAll">Delete all employees</a>
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
				<tbody>
					<?php 
						//here the loop to get data
					foreach ($employees as $row) {
						# code...
						echo "<tr>";
						echo "<td>".$row->id."</td>";
						echo "<td>".$row->name."</td>";
						echo "<td>".$row->email."</td>";
						echo "<td>0".$row->telephone."</td>";
						echo "<td>";
						echo "<a href='edit/".$row->id."' >edit </a> - ";
						echo "<a class='del' href='delete/".$row->id."' >delete </a> ";
						echo "</td>";
						echo "</tr>";
					}
					?>
				</tbody>
				</table>
		</div>
	</div>
</div>
<!--//end content of page -->
</body>
</html>