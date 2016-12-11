<!DOCTYPE html>
<html>
<head>
	<title>Edit Employee</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/style.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.validate.min.js"></script>
	<script type="text/javascript" >
		$(document).ready(function (){
			//validate form inputs
			$(".form").validate({
				rules: {
					name: {
						required: true	
					},
					email: {
						required: true,
						email: true,
						laxEmail: true
					},
					address: {
						required: true
					},
					telephone : {
						required: true,
						number: true,
						minlength: 10,
						maxlength: 10,
						telephone: true
					},
					salary:{
						required: true,
						digits: true,
						number: true,
						notEqual: 0
					},
					birthDate: {
						required: true,
						date: true
					},
					hireDate : {
						required: true,
						date: true	
					}


				},
				messages : {
					name: {
						required: "Please enter an employee name"
					},
					email: {
						required: "Please enter an employee email",
						email: "email must be in the form of xxx@yyy.zzz"
					},
					address: {
						required: "Please enter an employee address"	
					},
					telephone :{
						required: "Please enter an employee telephone",
						number: "Please enter a valid phone"
					},
					salary:{
						required: "Please enter an employee salary",
						digits: "Salary must not be numbers only",
						number: "slary must be numbers only"
					},
					birthDate: {
						required: "Please enter an employee birth date",
						date: "Date must be in thr form of 1991/05/20"
					},
					hireDate :{
						required: "Please enter an employee hire date",
						date: "Date must be in thr form of 1991/05/20"
					}

				}

			});	

			// $.validator.methods.telephone = function( value, element ) {
			//   return this.optional( element ) || /^022/.test( value );
			// }
			jQuery.validator.addMethod("telephone", function(value, element) {
			  // allow any non-whitespace characters as the host part
			  return this.optional( element ) || /^022/.test( value );
			}, 'Telephone must start with 022.');	

			jQuery.validator.addMethod("laxEmail", function(value, element) {
			  // allow any non-whitespace characters as the host part
			  return this.optional( element ) || /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test( value );
			}, 'Please enter a valid email address.');

			jQuery.validator.addMethod("notEqual", function(value, element, param) {
			  return this.optional(element) || value != param;
			}, "Please specify a different salary not 0");


});
	</script>
</head>
<body>
<!--start content of page -->
<div id="container">
	<div class="header"><h1>Employee Form</h1></div>
	<div><?php echo validation_errors(); ?></div>
	<div class="formadd">
		<form method="post" class="form" action="<?php echo $data->id; ?>">
			<table width="100%" class="addform">
				<tr>
					<td width="200px">Name</td>
					<td><input type="text" name="name" size="40" class="nameField" required value="<?php echo $data->name; ?>" /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="email" name="email" size="40" class="emailField" required value="<?php echo $data->email; ?>" /></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" size="40" class="addressField" required value="<?php echo $data->address; ?>" /></td>
				</tr>
				<tr>
					<td>Telephone</td>
					<td><input type="text" name="telephone" size="40" class="phoneField" required value="0<?php echo $data->telephone; ?>" /></td>
					<td><div class="error"></div></td>
				</tr>
				<tr>
					<td>Salary</td>
					<td><input type="text" name="salary" size="40" class="salaryField" required value="<?php echo $data->salary; ?>" /></td>
				</tr>
				<tr>
					<td>Date of birth</td>
					<td><input type="text" name="birthDate" size="40" class="birthField" required value="<?php echo $data->dateOfBirth; ?>" /></td>
				</tr>
				<tr>
					<td>Date of hire</td>
					<td><input type="text" name="hireDate" size="40" class="hireField" required value="<?php echo $data->dateOfHire; ?>" /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="btn" type="submit" name="editemployee" value="Edit The Employee" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<!--//end content of page -->
</body>
</html>
