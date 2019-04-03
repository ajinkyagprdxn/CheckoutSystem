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
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $prod_id = substr($url, strrpos($url, '=') + 1);

    $findid=mysqli_query($mysqli, "select * from users_login_creds where username='$username'");
    $resid=mysqli_fetch_array($findid);
    $userid=$resid['id'];
    echo "Users ID is = ".$userid;

    $cartnewadd = mysqli_query($mysqli, "select * from product_details where p_id=$prod_id"); // using mysqli_query instead    

    $prodres=mysqli_fetch_array($cartnewadd);

    $prod_name=$prodres['p_name'];
    $prod_price=$prodres['p_price'];

    $addproductcart = mysqli_query($mysqli, "INSERT INTO cartdata(c_id,c_prod_name,c_prod_price) VALUES($userid,'$prod_name','$prod_price')");

    $result = mysqli_query($mysqli, "select * from cartdata where c_id=$user_id"); // using mysqli_query instead    

    ?>     
    <a href="index.php" class="link_backtohome" title="Back to home">Back to home</a><br/><br/>                
    <h2>SHOPPING CART</h2>
    <?php 
    while($res = mysqli_fetch_array($result)) { ?>
    <ul class="cart_view">
            <ul>
              <li><p class="prod_name"><?php echo $res['c_prod_name'] ?></p></li>  
              <li><span class="prod_price">Rs. <?php echo $res['c_prod_price'] ?>/-</span></li>              
            </ul>
          </li>
    </ul>
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