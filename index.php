<?php

	$errors = array('cust_id'=>'', 'first_name'=>'', 'last_name'=>'', 'email'=>'', 'phone'=>'', 'password'=>'',
					'street_num'=>'', 'street_name'=>'', 'suburb'=>'', 'post_code'=>'');

	// check if form is submitted
	if(isset($_POST['submit'])){
		
			//check cust id
			if(empty($_POST['cust_id'])){
				$errors['cust_id'] = 'Customer ID is required <br/>';
			} else {
				$cust_id = $_POST['cust_id'];
				if(!preg_match('/^[0-9]{1,10}$/', $cust_id)){
					$errors['cust_id'] = 'Customer ID must be numbers only (max 10 characters)';
				}
			}
			
			//check first name
			if(empty($_POST['first_name'])){
				$errors['first_name'] = 'First name is required <br/>';
			} else {
				$first_name = $_POST['first_name'];
				if(!preg_match('/^[a-zA-Z\s ]{1,25}$/', $first_name)){
					$errors['first_name'] = 'First name must be letters and spaces only (max 25 characters)';
				}
			}
			
			//check last name
			if(empty($_POST['last_name'])){
				$errors['last_name'] = 'Last name is required <br/>';
			} else {
				$last_name = $_POST['last_name'];
				if(!preg_match('/^[a-zA-Z\s ]{1,50}$/', $last_name)){
					$errors['last_name'] = 'Last name must be letters and spaces only (max 50 characters)';
				}
			}
			
			//check email
			if(empty($_POST['email'])){
				$errors['email'] = 'Email is required <br/>';
			} else {
				$email = $_POST['email'];
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					$errors['email'] = 'Email must be a valid email address';
				}
			}
			
			//check phone
			if(empty($_POST['phone'])){
				$errors['phone'] = 'Phone number is required <br/>';
			} else {
				$phone = $_POST['phone'];
				if(!preg_match('/^[A-Za-z0-9]{10}$/', $phone)){
					$errors['phone'] = 'Phone number must be numbers only and 10 digits long';
				}
			}
			
			//check password
			if(empty($_POST['password'])){
				$errors['password'] = 'Password is required <br/>';
			} else {
				$password = $_POST['password'];
				if(!preg_match('/^[A-Za-z0-9]{8,25}$/', $password)){
					$errors['password'] = 'Password must be numbers and letters only and between 8 and 25 characters long';
				}
			}

			//check street number
			if(!empty($_POST['street_num'])){ 
				$street_num = $_POST['street_num'];
				if(!preg_match('/^[A-Za-z0-9]{1,10}$/', $street_num)){
					$errors['street_num'] = 'Street number must be letters and numbers only (10 characters max)';
			}


			//check street name
			if(!empty($_POST['street_name'])){
				$street_name = $_POST['street_name'];
				if(!preg_match('/^[A-Za-z ]{1,25}$/', $street_name)){
					$errors['street_name'] = 'Street name must be letters only (25 characters max)';
				}
			}
			

			//check suburb
			if(!empty($_POST['suburb'])){ 
				$suburb = $_POST['suburb'];
				if(!preg_match('/^[A-Za-z ]{1,25}$/', $suburb)){
					$errors['suburb'] = 'Suburb must be letters only (25 characters max)';
				}
			}

			// check post code
			if(!empty($_POST['post_code'])){ 
				$post_code = $_POST['post_code'];
				if(!preg_match('/^[0-9]{4}$/', $post_code)){
					$errors['post_code'] = 'Post code must be a 4 digit number';
				}
			}

			if(array_filter($errors)){
				//if form is invalid then do nothing
				// error messages will be displayed
			}
			else {
				// if form is valid then connect to database and insert data
				//
				// servername => localhost
				// username => root
				// password => empty
				// database name => task_9.2d
				$conn = mysqli_connect("localhost", "root", "", "test");
				
				// Check connection
				if($conn === false){
					die("ERROR: Could not connect. "
						. mysqli_connect_error());
				}
				
				// Taking all values from the form data(input)
				$cust_id = $_REQUEST['cust_id'];
				$first_name = $_REQUEST['first_name'];
				$last_name = $_REQUEST['last_name'];
				$email = $_REQUEST['email'];
				$phone = $_REQUEST['phone'];
				$password = $_REQUEST['password'];
				$street_num = $_REQUEST['street_num'];
				$street_name = $_REQUEST['street_name'];
				$suburb = $_REQUEST['suburb'];
				$post_code = $_REQUEST['post_code'];
				
				// Performing insert query execution
				// into table of name customer
				$sql = "INSERT INTO customer VALUES ('$cust_id','$first_name',
					'$last_name','$email','$phone','$password','$street_num','$street_name',
					'$suburb','$post_code')";
				
				if(mysqli_query($conn, $sql)){
					echo "<h3>data stored in a database successfully."
						. " Please browse mySQL"
						. " to view the updated data</h3>";
					} else{
						echo "ERROR: Hush! Sorry $sql. "
							. mysqli_error($conn);
					}
				
				// Close connection
				mysqli_close($conn);
			}
		}
	} // end of post check
?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <title>Task_9.2D</title>
	  <style>.red-text {color: #FF0000;}</style>
   </head>
   <body>
		<center>
			<h1>Uber Customer SignUp Form</h1>
			<form action="index.php" method="POST">
				
				<label>Customer ID:</label>
				<input type="decimal" name="cust_id">
				<div class="red-text"><?php echo $errors['cust_id']; ?></div>
				<br><br>
				
				<label>First Name:</label>
				<input type="text" name="first_name">
				<div class="red-text"><?php echo $errors['first_name']; ?></div>
				<br><br>
				
				<label>Last Name:</label>
				<input type="text" name="last_name">
				<div class="red-text"><?php echo $errors['last_name']; ?></div>
				<br><br>
				
				<label>Email Address:</label>
				<input type="text" name="email">
				<div class="red-text"><?php echo $errors['email']; ?></div>
				<br><br>
				
				<label>Phone Number:</label>
				<input type="text" name="phone">
				<div class="red-text"><?php echo $errors['phone']; ?></div>
				<br><br>
				
				<label>Password:</label>
				<input type="text" name="password">
				<div class="red-text"><?php echo $errors['password']; ?></div>
				<br><br>
				
				<label>Street Number:</label>
				<input type="text" name="street_num">
				<div class="red-text"><?php echo $errors['street_num']; ?></div>
				<br><br>
				
				<label>Street Name:</label>
				<input type="text" name="street_name">
				<div class="red-text"><?php echo $errors['street_name']; ?></div>
				<br><br>
				
				<label>Suburb:</label>
				<input type="text" name="suburb">
				<div class="red-text"><?php echo $errors['suburb']; ?></div>
				<br><br>
				
				<label>Post Code:</label>
				<input type="text" name="post_code">
				<div class="red-text"><?php echo $errors['post_code']; ?></div>
				<br><br>

				<input type="submit" name="submit" value="Add">
			</form>
		</center>
   </body>
</html>