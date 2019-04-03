<?php include_once("base_code.php") ?>
<body>
<?php 
	include_once("config.php");
	session_start();
	if(isset($_SESSION["sd_usn"]) && !empty($_SESSION["sd_usn"])) {
     header('Location: index.php');

	} else {
		$username=$_POST['username'];
	
		$password=$_POST['password'];		

		$temp=base64_encode($password);
		$password=$temp;

		if(isset($username,$password)) {
			//to prevent mysql injection
		$username = stripcslashes($username);
		$password = stripcslashes($password);

		//Query the database for username
		$result = mysqli_query($mysqli,"select * from users_login_creds where username = '$username' and password = '$password'") or die("Failed to query database");

		$row = mysqli_fetch_array($result);

		if($row['username'] == $username && $row['password'] == $password){
			echo "<font color='green'>Login success!!! Welcome ".$row['username']."</font>";
			//Storing SESSION VARIABLES

			// session_start();			
			$_SESSION["sd_usn"] = $username;
			$_SESSION["sd_pwd"] = $password;
			echo "<br/>";
			header('Location: index.php');
		} else {
			echo "<font color='red'>Failed to login! Please enter a valid username &amp; password.</font>";
		}
	
		}
	}
?>
	<h2>LOGIN PAGE</h2>
	
	<form action="" method="POST">
		<label for="username">Username</label>
		<input type="text" id="username" name="username" placeholder="username">
		<br/><br/>
		<label for="password">Password</label>
		<input type="password" id="password"  name="password" placeholder="password">
		<br/><br/>
		<input type="submit" value="Submit">
		<br/><br/>
		<p>Don't have an account?
			<a href="registration.php">Sign up for free</a>
		</p>
	</form>
</body>
</html>