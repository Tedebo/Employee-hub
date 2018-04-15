<?php
	date_default_timezone_set('America/New_York');
	session_start();

	if($_SESSION['con_log'] == 'con_log_true' && $_SESSION['con_log_accounting'] == 'con_log_accounting_true'){
		
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

		// GET LOGGED USER

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

		// GET ALL USERS

		$getUsers2 = "SELECT name, username, jobtitle, dob FROM users";
		$result2 = $conn->query($getUsers2);

		// SET TRANSACTIONS

		if(isset($_POST['tnameIn'])){
			$tnamepre = $_POST['tnameIn'];

			$getpreTrans = "SELECT amount, gross FROM transactions WHERE name='$tnamepre'";
			$resTrans = $conn->query($getpreTrans);

			if ($resTrans->num_rows > 0) {
			    // output data of each row
			    while($rowt = $resTrans->fetch_assoc()) {
			    	$gross = $rowt['gross'];
			    	$amountt = $rowt['amount'];
			        //echo $gross;
			    }
			}
		}
		//echo $gross;

		if(isset($_POST['tnameIn'])){$tname = $_POST['tnameIn'];}
		if(isset($_POST['tamountIn'])){$tamount = $_POST['tamountIn'];}
		$tdate = date("l jS \of F Y (h:i:s A)");

		

		if($_POST){

			$tgross = $gross + $_POST['tamountIn'];

			if(isset($_POST['subTrans'])){

				$insertTrans = "INSERT INTO transactions (name, amount, dateCreated, gross) VALUES ('$tname', '$tamount', '$tdate', '$tgross')";

				if ($conn->query($insertTrans) === TRUE) {	
					echo "New record created successfully";
				} else {
					echo "Error: " . $insertTrans . "<br>" . $conn->error;
				}
			}
			
		}
		
		// GET TRANSACTIONS

		$getTrans = "SELECT ID, name, amount, dateCreated FROM transactions ORDER BY ID DESC LIMIT 3";
		$resultTrans = $conn->query($getTrans);

		
	
	}else{
		header('Location: index.php');
	}
	

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Accounting</title>
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

			<div class="navbar-item level-item">
				<a class="navbar-item" href="accounting.php">
					Accounting
				</a>
			</div>

			<div class="navbar-item level-item">
				<a class="navbar-item" href="accountingData.php">
					Data
				</a>
			</div>

			<div class="navbar-item level-item">
				<a class="navbar-item" href="personalData.php">
					Personal Data
				</a>
			</div>

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
					<p class="title">Transaction</p>
					<form method="post">
						<div class="field">
						  <p class="is-size-5">
						  	To:
							<select name="tnameIn" class="select">
							<?php
								if ($result2->num_rows > 0) {
								    // output data of each row
								    while($row2 = $result2->fetch_assoc()) {
								        $nameGet2 = $row2['name'];
								        $usernameGet2 = $row2['username'];
								        $jobtitleGet2 = $row2['jobtitle'];
								        $dobGet2 = $row2['dob'];

								        //echo $usernameGet;
								    
								
							?>
							  <option value="<?php echo $nameGet2; ?>"><?php echo $nameGet2; ?></option>
							<?php }}?>
							</select>
							
						  </p>
						</div>

						<div class="field">
						  <p class="control has-icons-left">
							<input class="input" type="number" name="tamountIn" placeholder="$0.00" required>
							<span class="icon is-small is-left">
							  <i class="fa fa-usd"></i>
							</span>
						  </p>
						</div>

						<div class="field">
						  <p class="control">
							<button class="button is-success" name="subTrans">
							  Submit
							</button>
						  </p>
						</div>

					</form>
				</div>
			</div>
			
			<div class="tile is-8 is-vertical is-parent">
				<div class="tile is-child box">
					<p class="title">Latest</p>
					<?php
						if ($resultTrans->num_rows > 0) {
						// output data of each row
							while($row3 = $resultTrans->fetch_assoc()) {
								$tnameGet = $row3['name'];
								$tamountGet = $row3['amount'];
								$tdateGet = $row3['dateCreated'];
								$tidGet = $row3['ID'];

								$tamountSum = $tamountGet + $tamountGet;
								
								echo $tnameGet;
								echo '<p class="is-size-9 has-text-info">';
								echo $tdateGet;
								echo '</p>';
					?>
						<div class="box">
							<i class="fa fa-usd"></i><?php echo $tamountGet; ?>
						</div>
					<?php }} ?>
				</div>
				


			</div>
		
		</div>
	</div>
	<div class="section" id="cont">
		<div class="columns">
			<div class="column">
				<div class="box">
					<p class="title">Total Customers</p>
					<hr/>
					<p class="is-size-1 has-text-centered has-text-info"><?php echo $tamountSum; ?></p>
				</div>
				
				
			</div>
			
			

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