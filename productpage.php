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
    $result = mysqli_query($mysqli, "select * from product_details where p_id=$prod_id"); // using mysqli_query instead    
    ?>     
    <a href="index.php" class="link_backtohome" title="Back to home">Back to home</a> | <a href="cartpage.php" class="link_cartpage" title="Shopping Cart">Shopping Cart</a>
    <br/><br/>                
    <h2>PRODUCT INFORMATION</h2>
    <?php 
    while($res = mysqli_fetch_array($result)) { ?>
    <ul class="product_info_view">
					<li class="leftside">
            <img src='<?php echo $res['p_image'] ?>' class="productimage">
          </li>
          <li class="rightside">
            <ul>
              <li><p class="prodinfo_name"><?php echo $res['p_name'] ?></p></li>  
              <li><span class="prodinfo_category">Product Category: <?php echo $res['p_category'] ?></span></li>
              <li><span class="prodinfo_description"><?php echo $res['p_description'] ?></span></li>
              <li><span class="prodinfo_price">Rs. <?php echo $res['p_price'] ?>/-</span></li>
              <li>
                <a href="cartpage.php?id=<?php echo $res['p_id'] ?>" title="Add to cart" class="btn-add-cart">Add to cart</a>
              </li>
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