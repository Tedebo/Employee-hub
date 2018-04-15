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

		$getUsers = "SELECT username, password FROM users";
		$result = $conn->query($getUsers);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $usernameGet = $row['username'];
		        $passwordGet = $row['password'];
		        //echo $usernameGet;

		        if($_POST['usernameIn'] == $usernameGet && $_POST['passwordIn'] == $passwordGet){
		        	
		        	$_SESSION['con_log'] = 'con_log_true';
	 				$_SESSION['con_log_user'] = $_POST['usernameIn'];
	 				header('Location: index.php');

				}
		    }
		}

		
	}
	
	
	
	
	// foreach($docList as $doc){
	// 	$name = $doc['name'];
	// 	$user = $doc['username'];
	// 	$pass = $doc['password'];
		
	// 	//echo $user;
	// 	//var_dump($doc);
		
	// 	if($_POST){
	// 		if($_POST['username'] == $user && $_POST['password'] == $pass){
				
	// 			$_SESSION['con_log'] = 'con_log_true';
	// 			$_SESSION['con_log_user'] = $_POST['username'];
	// 			header('Location: index.php');
	// 		}
	// 	}
	// }
	
	
	
	//echo "Connected";
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hub Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
	<link rel="stylesheet" href="CSS\index.css">
  </head>
  <body>
    <div class="container">
      <h1 class="title">
        Employee Hub
      </h1>
      <p class="subtitle">
        Employee Login Only
      </p>
    
	<div class="section">
		<div class="tile is-ancestor">
		
			<div class="tile is-parent">
				<div class="tile is-child box">
				<form method="post">
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
						  <p class="control">
							<button class="button is-success">
							  Login
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