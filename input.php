<?php
	
	$servername = 'localhost';
	$username = 'root';
	$password = '';
	$dbname = 'DATA';

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die('Connection failed: ' . $conn->connect_error);
	}
	
	session_start();
	
	if($_POST){

		$getUsers = "SELECT username FROM users";
		$result = $conn->query($getUsers);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $usernameGet = $row['username'];
		        //echo $usernameGet;
		    }
		}

		if($_POST['passwordIn'] == $_POST['password2In']){

			if(isset($_POST['nameIn'])){$namePost = $_POST['nameIn'];}
			if(isset($_POST['usernameIn'])){$usernamePost = $_POST['usernameIn'];}
			if(isset($_POST['passwordIn'])){$passwordPost = $_POST['passwordIn'];}
			if(isset($_POST['jobtitleIn'])){$jobPost = $_POST['jobtitleIn'];}
			if(isset($_POST['dateIn'])){$datePost = $_POST['dateIn'];}

			if(isset($_POST['usernameIn'])){

				if($_POST['usernameIn'] == $usernameGet){
					
					echo 'Failed to add Data, Username matches one in Database.';
				
				}else{

					$insert = "INSERT INTO users (name, username, password, jobtitle, dob) VALUES ('$namePost', '$usernamePost', '$passwordPost', '$jobPost', '$datePost')";

					if ($conn->query($insert) === TRUE) {
					    echo "New record created successfully";
					} else {
					    echo "Error: " . $insert . "<br>" . $conn->error;
					}
				}
			}
		}else{

			echo 'Password does not match.';
		}
	}


?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Only</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
	<link rel="stylesheet" href="CSS\index.css">
  </head>
  <body>
    <div class="container">
      <h1 class="title">
        Admin Only
      </h1>
      <p class="subtitle">
        Secure Data
      </p>
    
	<div class="section">
		<div class="tile is-ancestor">
		
			<div class="tile is-parent">
				<div class="tile is-child box">
				<form method="post">
				
						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="text" name="nameIn" placeholder="Name" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-user"></i>
							</span>
						  </p>
						</div>
						
						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="text" name="jobtitleIn" placeholder="Job title" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-user-circle"></i>
							</span>
						  </p>
						</div>
						
						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="date" name="dateIn" placeholder="Date of Birth" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-calendar-o"></i>
							</span>
						  </p>
						</div>
						
						<div class="field">
						  <p class="control has-icons-left has-icons-right">
							<input class="input" type="email" name="usernameIn" placeholder="Email" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-envelope"></i>
							</span>
							<span class="icon is-small is-right">
							  <i class="fa fa-check"></i>
							</span>
						  </p>
						</div>
						
						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="password" name="passwordIn" placeholder="Password" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-lock"></i>
							</span>
						  </p>
						</div>
						
						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="password" name="password2In" placeholder="Confirm Password" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-lock"></i>
							</span>
						  </p>
						</div>
						
						
						<div class="field">
						  <p class="control">
							<button class="button is-success">
							  Add User
							</button>
						  </p>
						</div>
				</form>
				</div>
			</div>
		
		</div>
	</div>
	
	</div>
  </body>
</html>