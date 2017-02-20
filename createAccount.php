<?php 
   $page_title = 'Create A MyPassport Account';
   include ('includes/header.php');
   include ('includes/functions.php');
   require_once('includes/recaptchalib.php');
   require_once('includes/classes/Autoloader.php');


   $User = new User();
   $NJITUser = new njitStudent();
   $Non = new nonNjitStudent();
   $Non = new nonNjitStudent();
   $fs = new facultyStaff();

  

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	
	// Account Type 
	$accType = $_POST['accountType'];
	$n_email = $_POST['email'];
	
	
	$newUser = $User->handleGeneralUserForm();
	//$NJITUser->handle_NJITStudentForm($newUser);



		

		exit();
		
}
?>


<script>
var elem = document.getElementById("accountType");
elem.onchange = function(){
    var hiddenDiv = document.getElementById("contactInfo");
    hiddenDiv.style.display = (this.value == "") ? "none":"block";
};


</script>


<h1>Start Volunteering Today </h1>
<!-- <div id="studentSignUp">
<form class="contact_form" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="contact_form">
	<fieldset>
		<ul>
	   	 <li><h2>Account Type</h2></li>
	   	 <li>
			<select id="accountType" name="accountType" required>
			 <option value="NJITStudent" selected>NJIT Student</option>
			 <option value="NonNJITStudent">NON-NJIT Student Person</option>
			 <option value="FacultyStaff">Faculty And Staff</option>
			 <option value="Organization">Organization</option>
			</select>
	   	 </li>
		</ul>
	</fieldset>
     -->
    
    
    
	<div id="contactInfo"><?php $User->generateGeneralUserForm()?></div>
	
	<!-- <div id="submitBttn">
		<input type="submit" value="Submit">
	</div>
	 -->

	
	</ul>
	
	   </form>
	</div>
<?php

   include ('includes/footer.php');

?>