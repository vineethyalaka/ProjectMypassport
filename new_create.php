<?php 
   $page_title = 'Create A MyPassport Account';
   require 'includes/classes/Autoloader.php';
   include ('includes/header.php');
   include ('includes/functions.php');

$n = new User();
	print '<form class="smart-green">';

$n->generateGeneralUserForm();

   include ('includes/footer.php');

?>