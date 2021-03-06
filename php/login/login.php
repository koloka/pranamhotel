<?php // Script 9.6 - login.php #3
/* This page lets people log into the site (almost!). */
// Set the page title and include the header file:
define('TITLE','Login');
include('../../html/template/header-login.html');
include('connect.php');

?>
<div class="loginbody">

<div class="loginbodycenter">
<?php // Script 11.8 - login.php
/* This script logs a user in by check the stored values in text file. */
// Identify the file to use:
$file =  '../users/users.txt';
if ($_SERVER['REQUEST_METHOD'] == 'POST') { // Handle the form.
	if ( (!empty($_POST['username'])) && (!empty($_POST['password'])) ) {
		$loggedin = FALSE; // Not currently logged in.
		$isadmin = FALSE;
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = "SELECT * FROM users WHERE name='$username'";
		// $password = password_verify(trim($_POST['password']), $pw) ;
		$results = mysqli_query($dbc, $query);
		if (mysqli_num_rows($results) >= 1) {
			if($row = mysqli_fetch_assoc($results)){
				// $passcheck = password_verify($password, $row['password']);
				print $row['password'];
				print $row['name'];
				$iscorrect = password_verify($password, $row['password']);

				if ( $password == $row['confirmpassword']  ) {
					$loggedin = TRUE;
					if($username == 'admin'){
						$isadmin = TRUE;
					}
				}
			}

		}else {
			// array_push($errors, "Wrong username/password combination");
		}



		if ($loggedin) {
			if($isadmin){
				date_default_timezone_set('Asia/Phnom_Penh');
				session_start();
				$_SESSION['username'] = $_POST['username'];
				$_SESSION['loggedin'] = date('l F j, Y h:i A');
				$_SESSION['admin'] = TRUE;
				ob_end_clean();
				header('Location: ../admin/admin.php');
				exit();
			}
			date_default_timezone_set('Asia/Phnom_Penh');
			session_start();
			$_SESSION['username'] = $_POST['username'];
			$_SESSION['loggedin'] = date('l F j, Y h:i A');
			ob_end_clean(); // Destroy the buffer!
			header('Location: ../../index.php');
			exit();
		} else {
			print '<p class="text--error">The submitted email address and password do not match those on file!<br>Go back and try again.</p>';
			print '<a href="login.php" class = "loginagain"><p>login again! </p></a>';
		}
	} else{
		print '<p class="text--error">Please make sure you enter both an email address and a password!<br>Go back and try again.</p>';
		print '<a href="login.php" class = "loginagain"><p>login again! </p></a>';
	}
} else { // Display the form.
// Leave PHP and display the form:
?>
</div>

<form class="loginform" action="login.php" method="post" class="form--inline">
	<h2 class="logintitle1">Login Form</h2>
	<input class="boxsize" type="text" name="username" size="30" placeholder="Username">
	<input class="boxsize" type="password" name="password" size="30" placeholder="password">
	<p><input type="submit" name="submit" value="Log In!" class="button--pill"></p>
	<a href="../../index.php" class="discover"><p>Discover without Login</p></a>
	<a href="register.php" class="discover"><p>Sign Up</p></a>



</form>
<?php } // End of submission IF. ?>
</div>
<?php
include('../../html/template/footer-login.html');
?>
