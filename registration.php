<?php 
include_once("config.php");
session_start();
if(isset($_SESSION["sd_usn"]) && !empty($_SESSION["sd_usn"])) {
 header('Location: index.php');

} else {

 $username=$_POST['username'];
 $password=$_POST['password'];
 $repassword=$_POST['repassword'];
 $fullname=$_POST['fullname'];
 $gender=$_POST['gender'];
 $dob=$_POST['dob'];
 $mobile=$_POST['mobile'];
$email=$_POST['email'];
$address=$_POST['address'];
$zipcode=$_POST['zipcode']; 

 if(isset($username, $password, $repassword, $fullname, $gender, $dob, $mobile, $email, $address, $zipcode)) {

    //to prevent mysql injection
   $username = stripcslashes($username);
   $password = stripcslashes($password);
   $repassword = stripcslashes($repassword);

    // checking empty fields
   if(empty($username) || empty($password) || empty($repassword)) {
    if(empty($username)) {
      echo "<font color='red'>Username field is empty.</font><br/>";
    }

    if(empty($password)) {
      echo "<font color='red'>Password field is empty.</font><br/>";
    }

    if(empty($repassword)) {
      echo "<font color='red'>Repeat password field is empty.</font><br/>";
    }       

    //link to the previous page
    echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
  } else {        

    $un_res=mysqli_query($mysqli, "SELECT * FROM users_login_creds WHERE username='$username'");
    $row = mysqli_fetch_array($un_res);
    if($row['username'] == $username){
      echo "<font color='red'>Username already exists!</font><br/>";
      //link to the previous page
      echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
    } else {  
      if($password == $repassword) { 
        //Encrypt the password
        $temp=base64_encode($password);
        $password=$temp;
        //insert data to database
        $result = mysqli_query($mysqli, "INSERT INTO users_login_creds(username,password) VALUES('$username','$password')");

        $newid_rows = mysqli_query($mysqli, "select distinct id from users_login_creds where username='".$username."'");        
        if($newid_rows) {
          $newid = mysqli_fetch_array($newid_rows);
          $newid = $newid['id'];
          var_dump('new_id -->'.$newid);
          $result2 = mysqli_query($mysqli, "INSERT INTO user_profile(u_id, u_name,u_gender, u_dob, u_mobile, u_email, u_address, u_zipcode) VALUES($newid, '$fullname', '$gender', $dob, $mobile, '$email', '$address', $zipcode)");
        }

        //display success message
        echo "<font color='green'>New user added successfully.</font>";
        echo "<br/><a href='login.php'>Go to Login Page.</a>";

      } else {
        echo "<font color='green'>Username is available!</font><br/>";
        echo "<font color='red'>Passwords did not match!.</font><br/>";

        //link to the previous page
        echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
      }      
    }
  }		
}
}
?>
<?php include_once("base_code.php") ?>
<body>
	<h2>New Bank Account Registration</h2>
	<h6>Bank Application Example</h6>
	<form action="" method="POST">
    <hr/><br/>
    <label for="username">Enter Username: </label>
    <input type="text" id="username" name="username" placeholder="username">
    <br/><br/>
    <label for="password">Create Password: </label>
    <input type="password" id="password"  name="password" placeholder="password">
    <br/><br/>
    <label for="repassword">Repeat Password: </label>
    <input type="password" id="repassword"  name="repassword" placeholder="Re-enter password">
    <br/><br/><hr/>
    <label for="fullname">fullname Name: </label>
    <input type="text" id="fullname"  name="fullname" placeholder="Full Name" required="required">
    <br/><br/>
    <label for="gender">Gender: </label>    
    <select name="gender" id="gender" required="required">
      <option value="Male">Male</option>
      <option value="Female">Female</option>
    </select>
    <br/><br/>
    <label for="dob">Date of Birth: </label>
    <input type="date" id="dob"  name="dob" placeholder="Date of Birth" required="required">
    <br/><br/>    
    <label for="mobile">Mobile: </label>
    <input type="number" id="mobile"  name="mobile" max="9999999999" placeholder="Mobile Number" required="required">
    <br/><br/>
    <label for="email">Email: </label>
    <input type="email" id="email"  name="email" placeholder="Email ID" required="required">
    <br/><br/>
    <label for="address">Address: </label>
    <textarea name="address" id="address" maxlength="500"></textarea>
    <br/><br/>
    <label for="zipcode">Pin Code: </label>
    <input type="number" id="zipcode"  name="zipcode" max="999999" placeholder="Zip Code e.g. 400123" required="required">
    <br/><br/>
    <input type="submit" name="submit" value="Register">
    <input type="reset" value="Clear">
    <br/><br/>
    <p>Already registered? 
     <a href="login.php">Go to Login Page</a>
   </p>
 </form>
</body>
</html>