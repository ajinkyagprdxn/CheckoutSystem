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
    $result = mysqli_query($mysqli, "select * from product_details"); // using mysqli_query instead    
    ?>     
    <a href="userprofile.php" class="link_userprofile" title="Profile">Profile</a><br/><br/>                
    <h2>AVAILABLE PRODUCTS</h2>

    <ul class="products_view">
    <?php 
    while($res = mysqli_fetch_array($result)) { ?>
    	<li>
    		<a href="productpage.php?id=<?php echo $res['p_id'] ?>" title="<?php echo $res['p_name'] ?>" id="productlink">
				<ul class="singleproduct">
					<li><img src='<?php echo $res['p_image'] ?>' class="productimage"></li>	
				    <li><p><?php echo $res['p_name'] ?></p></li>	
				   	<li><span>Rs. <?php echo $res['p_price'] ?>/-</span></li>
				</ul>    			
    		</a>
		</li>
    <?php
  }
} else { ?>
    </ul>
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