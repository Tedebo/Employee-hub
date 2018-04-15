<?php
	session_start();
	if($_SESSION['con_log'] == 'con_log_true'){
		
		if($_POST){
			if(isset($_POST['logoutbtn'])){
				session_unset();
				session_destroy();
				header('Location: hub.php');
			}
		}
			
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

		$conUser = $_SESSION['con_log_user'];

		$getUsers = "SELECT name, username, jobtitle, dob FROM users WHERE username='$conUser'";
		$result = $conn->query($getUsers);

		if ($result->num_rows > 0) {
		    // output data of each row
		    while($row = $result->fetch_assoc()) {
		        $nameGet = $row['name'];
		        $usernameGet = $row['username'];
		        $jobtitleGet = $row['jobtitle'];
		        $dobGet = $row['dob'];
		        //echo $usernameGet;
		    }
		}
		
		

		if($jobtitleGet == 'Manager'){
			$_SESSION['con_log_accounting'] = 'con_log_accounting_true';
			//header('Location: accounting.php');
		}

		if(isset($_SESSION['con_log_user'])){
			//echo $_SESSION['con_log_user'];
		}


		// GET TRANSACTIONS

		$getTrans = "SELECT ID, name, amount, dateCreated FROM transactions WHERE name='$nameGet' ORDER BY ID DESC LIMIT 3";
		$resultTrans = $conn->query($getTrans);

		$getpreTrans = "SELECT amount, gross FROM transactions WHERE name='$nameGet'";
		$resTrans = $conn->query($getpreTrans);

		if ($resTrans->num_rows > 0) {
		    // output data of each row
		    while($rowt = $resTrans->fetch_assoc()) {
		    	$gross = $rowt['gross'];
		    	$amountt = $rowt['amount'];
		        //echo $gross;
		    }
		}


	}else{
		header('Location: hub.php');
	}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.6.1/css/bulma.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<link rel="stylesheet" href="CSS/index.css">
	<script src="JS/index.js"></script>
  </head>
  <body>
  	<nav class="navbar is-light level">
  			<div class="navbar-item">
				<a class="navbar-item" class="logo">
					<b>Employee Hub</b>
				</a>
  			</div>
			
			<div class="navbar-item level-item">
				<a class="navbar-item" href="index.php">
					Home
				</a>
			</div>	

			<div class="navbar-item level-item">
				<a class="navbar-item">
					Time Off
				</a>
			</div>

			<?php 
				if($jobtitleGet == 'Manager'){
					echo '
					<div class="navbar-item level-item">
						<a class="navbar-item" href="accounting.php">
							Accounting
						</a>
					</div>
					';

					echo '
					<div class="navbar-item level-item">
						<a class="navbar-item" href="accountingData.php">
							Data
						</a>
					</div>
					';

					echo '
					<div class="navbar-item level-item">
						<a class="navbar-item" href="personalData.php">
							Personal Data
						</a>
					</div>
					';
				}else{

					echo '
					<div class="navbar-item level-item">
						<a class="navbar-item" href="personalData.php">
							Data
						</a>
					</div>
					';
				}

			?>

			<div class="navbar-item level-item">
				<a class="navbar-item" href="profile.php">
					Profile
				</a>
			</div>
			
			<div class="navbar-item level-right">
				<form method="post">
					<div class="field">
						<p class="control">
							<button class="button is-danger" name="logoutbtn">
								Logout
							</button>
						</p>
					</div>
				</form>
			</div>
		</nav>
    <div class="container">
	
		
	<div id="headerTitle">
		<h1 class="title">
			
		</h1>
		<p class="subtitle">
			Welcome back, <?php echo $nameGet;?>
		</p>
    </div>
	
	<div class="section">
		<div class="tile is-ancestor">
		
			<div class="tile is-4 is-parent">
				<div class="tile is-child box">
					<!--<p class="title">Tile1</p>-->
					<figure class="image is-64x64">
					  <img src="profile1.jpg">

					</figure>
					<br/>
					<hr/>
					<p class="is-size-6 has-text-weight-bold">Legal Name:</p><p><?php echo $nameGet;?></p>
					<p class="is-size-6 has-text-weight-bold">Job Title:</p><p><?php echo $jobtitleGet;?></p>
					<p class="is-size-6 has-text-weight-bold">Date of birth:</p><p><?php echo $dobGet;?></p>
					<p class="is-size-6 has-text-weight-bold">Email:</p><p><?php echo $usernameGet;?></p>
				</div>
			</div>
			
			<div class="tile is-8 is-vertical is-parent">
				<div class="tile is-child box">
					<p class="title"><i class="fa fa-calendar" aria-hidden="true"></i> Schedule</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-light">Sunday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-bold">Monday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-bold">Tuesday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-bold">Wednesday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-bold">Thursday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-bold">Friday</p>
					<hr/>
					<p class="is-size-4 has-text-centered has-text-weight-light">Saturday</p>
				</div>
				

			</div>
		
		</div>
	</div>
	
	<div class="section">
		<div class="tile is-ancestor">
		
			
			
			
		
		</div>
	</div>




	</div>
	<br/>
	<footer class="footer">
  <div class="container">
    <div class="content has-text-centered">
      <p>
        &#169;2017 <strong>Goon Studios, LLC.</strong> 	
      </p>
    </div>
  </div>
</footer>
  </body>
</html>