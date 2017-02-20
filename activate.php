<?php 
   $page_title = 'Create A MyPassport Account';
   include ('includes/header.php');
   include ('includes/functions.php');
   require_once('includes/classes/Autoloader.php');


	$email =  $_GET['x'];
	$code =  $_GET['y'];
	
	
	$User = new User();

	$User->activateUser($email, $code);
	




   include ('includes/footer.php');

?>