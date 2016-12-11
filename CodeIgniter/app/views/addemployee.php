<!DOCTYPE html>
<html>
<head>
	<title>Add Employee</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/style.css">
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery.validate.min.js"></script>
	<script type="text/javascript" >
		$(document).ready(function (){
			//validate form inputs through jquery validation library
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
		<form method="post" class="form" action="add">
			<table width="100%" class="addform">
				<tr>
					<td width="200px">Name</td>
					<td><input type="text" name="name" placeholder="Enter employee Name" size="40" class="nameField" required  /></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><input type="email" name="email" placeholder="Enter employee Email" size="40" class="emailField"  required /></td>
				</tr>
				<tr>
					<td>Address</td>
					<td><input type="text" name="address" placeholder="Enter employee Address" size="40" class="addressField"  required /></td>
				</tr>
				<tr>
					<td>Telephone</td>
					<td><input type="text" name="telephone" placeholder="eg : 0221234567" size="40" class="phoneField"  required /></td>
				</tr>
				<tr>
					<td>Salary</td>
					<td><input type="text" name="salary" placeholder="Enter employee Salary" size="40" class="salaryField"  required /></td>
				</tr>
				<tr>
					<td>Date of birth</td>
					<td><input type="text"  name="birthDate" placeholder="Eg : 1991/05/20" size="40" id="datePicker" class="birthField"  required  /></td>
				</tr>
				<tr>
					<td>Date of hire</td>
					<td><input type="text" placeholder="Eg : 1991/05/20" name="hireDate" size="40" class="hireField"  required /></td>
				</tr>
				<tr>
					<td colspan="2">
						<input class="btn" type="submit" name="addemployee" value="Add An Employee" />
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>
<!--//end content of page -->
</body>
</html>