<?php include_once("base_code.php") ?>
<body>
  <?php
  //including the database connection file
  include_once("config.php");
  session_start();
  if(isset($_SESSION["sd_usn"]) && !empty($_SESSION["sd_usn"])) { ?>
    <a href='logout.php'>Logout</a><br/>
    <?php  $username=($_SESSION["sd_usn"]);?>
    <p>You're logged in as: <b><?php echo $username ?> (admin)</b></p>
    <h2>CHECKOUT SYSTEM (with Login and Logout)</h2>
    <?php
    //fetching data in descending order (lastest entry first)
    $result = mysqli_query($mysqli, "select * from users_login_creds as ulc inner join user_profile as up on (ulc.id = up.u_id) where ulc.username='".$username."'"); // using mysqli_query instead    
    ?>     
    <a href="index.php" class="link_backtohome" title="Back to home">Back to home</a> | <a href="cartpage.php" class="link_cartpage" title="Shopping Cart">Shopping Cart</a>
    <br/><br/>          
    <h2>USER PROFILE</h2>
    <?php 
    while($res = mysqli_fetch_array($result)) { ?>
      <table class='account_view' cellspacing=3px>
        <tr>
            <td>Full Name</td>
            <td><?php echo $res['u_name'] ?></td>
        </tr>
        <tr>
            <td>Gender</td>
            <td><?php echo $res['u_gender'] ?></td>
        </tr>
        <tr>
            <td>Date Of Birth</td>
            <td><?php echo $res['u_dob'] ?></td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td><?php echo $res['u_mobile'] ?></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><?php echo $res['u_email'] ?></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><?php echo $res['u_address'] ?></td>
        </tr>
        <tr>
            <td>Zip Code</td>
            <td><?php echo $res['u_zipcode'] ?></td>
        </tr>
    </table>
    <?php
  }
} else { ?>
    <a href='login.php'>Login</a>
    <br/><br/>
    <p>
      Don't have an account? 
      <a href='registration.php'>Sign up for free</a>
  </p>
  <h2>CHECKOUT SYSTEM (with Login and Logout)</h2>
<?php } ?>  
</body>
</html>