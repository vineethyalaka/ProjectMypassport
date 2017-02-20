<?php

	include ('includes/functions.php');
	include ('includes/header.php');
    //include ('../includes/check_session.php');

    session_start();

	$u_id = $_SESSION['user_id'];
	$type = $_SESSION['sessionType'];
	

	$sSQL = "INSERT INTO civic_sessions(user_id, account_type, action) VALUES ('$u_id','$type','logout')";
				
	$nResult = mysql_query($sSQL) or die(mysql_error());
	
    session_destroy();

     ?>
     
     <div style="text-align:center;">
     
	<p> You have successfully </p>
    <h2> Logged Out of </h2>
    <h1> MyPassport</h1>
    
    <h3>For security purposes, please exit your browser. </h3>    
    
    <hr />
    
    <p><strong>Want to log in again ? </strong></p>
    <p> If you did not intend to log out, were logged out by mistake, or logged out for some other reason, you can always 
    <a href="http://www.njit.edu/cds/civic/mypassport/loginUser.php"> Log In </a>again.</p>
    
     
     </div>
     

	

     
<?php
	include ('includes/footer.php');
?>




