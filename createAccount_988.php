<?php 
   $page_title = 'Create A MyPassport Account';
   include ('includes/header.php');
   include ('includes/functions.php');
   require_once('includes/recaptchalib.php');

   
    $publickey = "6LdT9-0SAAAAAOFYcfSv68n9x5x4d6gjkUKwPwu3"; // you got this from the signup page


if ($_SERVER['REQUEST_METHOD'] == POST){


  $privatekey = "6LdT9-0SAAAAAI2EDt8hhrQRZCrkV6vcy-1t12v3";

  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
  
    // What happens when the CAPTCHA was entered incorrectly
    
    errorMessageWithCustomText("The VALIDATION TEXT you entered was incorrect, please go back and try again.");
    include ('includes/footer.php');
    die ();
  
  
  
  } else {
	 
	
	// Account Type 
	$accType = $_POST['accountType'];
	
	// Personal Information
	$n_title = mysql_real_escape_string($_POST['title']);
	$n_firstName = mysql_real_escape_string($_POST['firstName']);
	$n_lastName = mysql_real_escape_string($_POST['lastName']);
	$n_email = mysql_real_escape_string($_POST['njitEmail']);
	$n_sec_email = mysql_real_escape_string($_POST['secondaryEmail']);
	$n_phoneNumber = mysql_real_escape_string($_POST['phoneNumber']);
	
	
	//NJIT Student
	$n_major = mysql_real_escape_string($_POST['major']);
	$n_classLevel = mysql_real_escape_string($_POST['year_level']);
	$n_gradDate = mysql_real_escape_string($_POST['graduationDate']);
	
	//NON-NJIT Student
	$n_address = mysql_real_escape_string($_POST['address']);
	$n_city = mysql_real_escape_string($_POST['city']);
	$n_state = mysql_real_escape_string($_POST['state']);
	$n_zip = mysql_real_escape_string($_POST['zipcode']);
	$n_schoolName = mysql_real_escape_string($_POST['schoolName']);
	$n_contactName = mysql_real_escape_string($_POST['contactName']);
	$n_contactEmail = mysql_real_escape_string($_POST['contactEmail']);
	$n_contactPhone = mysql_real_escape_string($_POST['contactPhone']);
	
	//NJIT Faculty & Staff
	$n_department = mysql_real_escape_string($_POST['department']);
	$n_service = mysql_real_escape_string($_POST['servelearn']);
	
	//Organization
	$n_organization_name = mysql_real_escape_string($_POST['organizationName']);
	$n_organization_website = mysql_real_escape_string($_POST['organizationWebsite']);
	$n_organization_phone_number = mysql_real_escape_string($_POST['o_phone']);
	$n_organization_description = mysql_real_escape_string($_POST['organizationDescription']);
	$n_organization_address = mysql_real_escape_string($_POST['organizationAddress']);
	$n_organization_agencyType  = mysql_real_escape_string($_POST['agencyType']);
	
	$n_password = passwordGenerator(8);
	$created = date('Y-m-d H:i:s');
	$sendEmail = 'yes';


//	First Check to See if the user exists !!  	

	$checkUser = "SELECT * FROM civic_users WHERE email = '$n_email'";

	$result = mysql_query($checkUser);;

	$count = mysql_num_rows($result);

    if( $count >=  1 ) {
	    	
	   errorMessageWithCustomText('Email Account already exists. Please try to reset your password or 
	    				contact Civic Engagement @ NJIT for additional assistance.');
	   																																												
		include ('includes/footer.php');
	  	exit;
	  	
	  	
	  	}
	$sql = "INSERT INTO civic_users (
						acct_type, title, first_name, last_name, email, secondary_email, phone_number,
                        major, graduation_date, class_standing,                 
                        address, city, state, zipcode, college_name,
                        contact_name, contact_email, contact_phone,     
                        service_learning, department, 
                        agency_name, agency_description, agency_address, agency_type, 
						agency_website, agency_phone,
                        password, date_created, status, user_level
                    ) VALUES (            
                		'$accType', '$n_title', '$n_firstName', '$n_lastName', '$n_email', '$n_sec_email',
                		'$n_phoneNumber', '$n_major', '$n_gradDate', '$n_classLevel', '$n_address',
                		'$n_city', '$n_state', '$n_zip', '$n_schoolName', '$n_contactName', '$n_contactEmail',
                		'$n_contactPhone', '$n_service', '$n_department',						
						'$n_organization_name', 
                		'$n_organization_description', '$n_organization_address', '$n_organization_agencyType',
						'$n_organization_website', '$n_organization_phone_number',
						SHA1('$n_password'), '$created', 'Active', 'standard')";
                		
	$r = mysql_query($sql);
	
	if ($r){
	
		//echo '<div class="success">Account Created - please check your email for further instruction.</div>';
	
    // Message Body
		$message = '<strong> ' . $n_title . ' ' . $n_firstName . ' '. $n_lastName .'</strong><br />';
		$message .= 'Your account has been created for you at MyPassport.' ;
		$message .= '<p>Your username is: ' . $n_email . '.<br />';
		
		$message .= 'Your password is: ' . $n_password . '. <br /><br />';
		
		$message .= 'Please login at: <a href="http://www.njit.edu/cds/civic/mypassport/loginUser.php"> MyPassport</a>.';

		$message .= '<br /><br />Thank-you <br /> Civic Engagement @ NJIT<br>Career Development Services</p>';
		
		$n_message = mailer("MyPassport Account Created", $message);
		
		//Recipients
		$to = $n_email;
	
		//Subject Line
		$subject = "Civic Engagement @ NJIT - SignUp Confirmation and Password";
	
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: cecc@njit.edu <cecc@njit.edu>' . "\r\n";
	
		// Send the Email
	
		//print $n_message;
	
		$send = mail($to, $subject, $n_message, $headers);
		
		
		
		print '<h2 text-align="center"> Thanks for Signing Up ! </h2>';
		
  		print '<h2 text-align="center"> Check Your Email </h2>';

  		print '<p> Please check your inbox for further instructions on logging into MyPassport.</p>';
		
		
		
	
	} else {
		
		die('Error:'.mysql_error());
		
		print $sql;
		
		
		
	}

	
	
	
	
			

		include ('includes/footer.php');
	  	exit;
			
			
  }//correct valid captcha
  
}//end of server request

?>
<h1>Start Volunteering Today </h1>
<p>Please complete information required in th</p>
<div id="studentSignUp">
<form class="contact_form" action="<?=$_SERVER['PHP_SELF']?>" method="post" name="contact_form">


<fieldset>
	<ul>
   	 <li><h2>Account Type</h2></li>
   	 
   	 <li>
		<select id="accountType" name="accountType">
		 <option value="#" selected>Choose One</option >
		 <option value="NJITStudent">NJIT Student</option>
		 <option value="NonNJITStudent">NON-NJIT Student Person</option>
		 <option value="FacultyStaff">Faculty And Staff</option>
		 <option value="Organization">Organization</option>
		</select>
   	 </li>
	</ul>
</fieldset>

   	


<div id="contactInfo">
           <ul>
   	 <fieldset>
   	 <h2>Contact Information</h2>
   	 <li>
   	 <label for="name">Title</label>
   	 <input type="text"  name="title" placeholder="Title" required />
   	 <span class="form_hint">Mr. / Ms. / Mrs. / Dr.</span>
   	 </li>
   	 <li>
   	 <label for="name">First Name:</label>
   	 <input type="text" name="firstName" placeholder="First Name"  required/>
   	 </li>
   	 <li>
   	 <label for="name">Last Name:</label>
   	 <input type="text"  name="lastName" placeholder="Last Name"  required/>
   	 </li>

   	 <li>
   	 <label for="email">Primary / NJIT Email:</label>
   	 <input type="email" name="njitEmail" placeholder="john_doe@njit.edu"  required/>
   	 <span class="form_hint">Proper format "UCID@njit.edu"</span>
   	 </li>
   	 <li>
   	 <label for="email">Secondary Email:</label>
   	 <input type="email" name="secondaryEmail" />
   	 </li>
<li>
   	 <label for="phone">Phone Number:</label>
   	 <input type="phone" name="phoneNumber" />
   	 </li>


   	 </ul>
   	 </fieldset>
   	</div>
   	
   
<div id="njitStudent">
<ul>
   <fieldset>
           <h2>NJIT Student School Information</h2>
            <li>
<label for="name">Current Major:</label>
<select name="major">
<option>Choose One ...</option>
               <?php 

$sql = "SELECT * FROM civic_majors";

$r = mysql_query($sql);

if ($r){

while( $result = mysql_fetch_array($r)){

print '<option value="' . $result['id'] . '">' . $result['degree_level'] . ' - ' . $result['college'] . ' - ' . $result['major'] .'</option>' ;


}



}


?>
</select>
</li>
<li>
   	 <label for="classLevel">Class Level:</label>
	<select name="year_level">
	<option value=""></option>
	<option value="Freshman/First Year">Freshman/First Year</option>
	<option value="Sophomore">Sophomore</option>
	<option value="Junior">Junior</option>
	<option value="Senior">Senior</option>
	<option value="Masters">Masters</option>
	<option value="Doctoral">Doctoral</option>
	<option value="Post-Doctoral">Post-Doctoral</option>
	<option value="Alumni">Alumni</option>
	<option value="First Professional Year">First Professional Year</option>
	<option value="Second Professional Year">Second Professional Year</option>
	<option value="Third Professional Year">Third Professional Year</option>
	<option value="Fourth Professional Year">Fourth Professional Year</option>
	</select>
</li>

<li>
   	 <label for="grad">Graduation Date</label>
   	 <input type="date" name="graduationDate" />
   	 <span class="form_hint">Date Format: <(2)month>/<(2)date>/<((4)year>></span>
   	 </li>
</ul>
</fieldset>
</div>

<div id="nonNJITStudent">
           <ul>
               <fieldset>
       	 <h2>Personal Contact Information</h2>
       	 <p>Please provide your contact information for our records.</p>	
<li>
   	 <label for="name">Address</label>
   	 <input type="text"  name="address" />
   	 </li>	
<li>
   	 <label for="name">City</label>
   	 <input type="text"  name="city" />
   	 </li>	
<li>
   	 <label for="name">State</label>
   	 <input type="text"  name="state" />
   	 </li>	
<li>
   	 <label for="name">Zip Code</label>
   	 <input type="text"  name="zipcode" />
   	 </li>	
   	 </fieldset>
   	 <fieldset>
   	 <h2>College Information</h2>
   	 <p>The following information is used in communication with your college / university to report your volunteer hours.</p>	
   	 <li>
   	 <label for="name">School Name:</label>
   	 <select name="schoolName"> 
		<option value=""></option>
		<option value="Atlantic Cape Community College">Atlantic Cape Community College</option>
		<option value="Bergen Community College<">Bergen Community College</option>
		<option value="Berkeley College">Berkeley College</option>
		<option value="Bloomfield College<">Bloomfield College</option>
		<option value="Brookdale Community College">Brookdale Community College</option>
		<option value="Burlington County College">Burlington County College</option>
		<option value="Caldwell College">Caldwell College</option>
		<option value="Camden County College">Camden County College</option>
		<option value="Centenary College">Centenary College</option>
		<option value="College of Saint Elizabeth<">College of Saint Elizabeth</option>
		<option value="County College of Morris">County College of Morris</option>
		<option value="Cumberland County College">Cumberland County College</option>
		<option value="Devry University">DeVry University</option>
		<option value="Drew Univeristy">Drew University</option>
		<option value="Essex County College">Essex County College</option>
		<option value="Fairleigh Dickinson University">Fairleigh Dickinson University</option>
		<option value="Felician College">Felician College</option>
		<option value="Georgian Court University">Georgian Court University</option>
		<option value="Gloucester County College">Gloucester County College</option>
		<option value="Hudson Community College">Hudson Community College</option>
		<option value="Kean University">Kean University</option>
		<option value="Mercer County College">Mercer County College</option>
		<option value="Middlesex County College">Middlesex County College</option>
		<option value="Monmouth University">Monmouth University</option>
		<option value=">Montclair State University">Montclair State University</option>
		<option value="New Brunswick Theological Seminary">New Brunswick Theological Seminary</option>
		<option value="NJ City University">NJ City University</option>
		<option value="Ocean County College">Ocean County College</option>
		<option value="Passaic County College">Passaic County College</option>
		<option value="Princeton Theological Seminary">Princeton Theological Seminary</option>
		<option value="Princeton University">Princeton University</option>
		<option value="Ramapo College of NJ">Ramapo College of NJ</option>
		<option value="Raritan Valley Commuinty College">Raritan Valley Community College</option>
		<option value="Richard Stockton College of NJ">Richard Stockton College of NJ</option>
		<option value="Rider University">Rider University</option>
		<option value="Rowan University">Rowan University</option>
		<option value="Rutgers - Camden">Rutgers - Camden</option>
		<option value="Rutgers - New Brunswick">Rutgers - New Brunswick</option>
		<option value="Rutgers - Newark">Rutgers - Newark</option>
		<option value="Saint Peter's College">Saint Peter's College</option>
		<option value="Salem Community College">Salem Community College</option>
		<option value="Seton Hall University">Seton Hall University</option>
		<option value="Somerset Christian College">Somerset Christian College</option>
		<option value="Stevens Institute of Technology">Stevens Institute of Technology</option>
		<option value="Sussex County Commuinty College">Sussex County Community College</option>
		<option value="The College of NJ (TCNJ">The College of NJ (TCNJ)</option>
		<option value="UMDNJ - Newark">UMDNJ - Newark</option>
		<option value="UMDNJ - Stratford">UMDNJ - Stratford</option>
		<option value="Union County College">Union County College</option>
		<option value="Warren County Community College">Warren County Community College</option>
		<option value="William Paterson University of NJ">William Paterson University of NJ</option>
		<option value="Other">Other</option>
		</select>
   	 
   	 
   	    	 </li>
   	    	 
   	    	 
<li>
   	 <label for="classLevel">Class Level:</label>
	<select name="non_year_level">
	<option value=""></option>
	<option value="Freshman/First Year">Freshman/First Year</option>
	<option value="Sophomore">Sophomore</option>
	<option value="Junior">Junior</option>
	<option value="Senior">Senior</option>
	<option value="Masters">Masters</option>
	<option value="Doctoral">Doctoral</option>
	<option value="Post-Doctoral">Post-Doctoral</option>
	<option value="Alumni">Alumni</option>
	<option value="First Professional Year">First Professional Year</option>
	<option value="Second Professional Year">Second Professional Year</option>
	<option value="Third Professional Year">Third Professional Year</option>
	<option value="Fourth Professional Year">Fourth Professional Year</option>
	</select>
</li>
   	    	 
   	 <li>
   	 <label for="name">Major:</label>
   	 <input type="text"  name="non_major" />
   	 </li>
   	   	 
   	 <li>
   	 <label for="name">School Contact Person:</label>
   	 <input type="text"  name="contactName" />
   	 </li>
   	 <li>
   	 <label for="name">School Contact Email:</label>
   	 <input type="email"  name="contactEmail" />
   	 </li>
   	 <li>
   	 <label for="name">Contact Phone Number:</label>
   	 <input type="text"  name="contactPhone" />
   	 </li>
   	 </fieldset>	


   	 </ul>
   	 </fieldset>
   	</div>

<div id="njit-fac">
   <ul>
       <fieldset>
           <h2>NJIT Faculty & Staff Information</h2>
           <li>
               <label for="name">Department Name</label>
               <select name="department">
               		<option selected value="">None</option>

					<option value="Academic Affairs">Academic Affairs</option>
					<option value="Academic Computing Services">Academic Computing Services</option>
					<option value="Accounting">Accounting</option>
					<option value="Accounts Payable">Accounts Payable</option>
					<option value="Administration and Treasurer">Administration and Treasurer</option>
					<option value="Alumni Relations">Alumni Relations</option>
					<option value="New Jersey School of Architecture and Design">New Jersey School of Architecture and Design</option>
					<option value="Athletics">Athletics</option>
					<option value="Budget">Budget</option>
					<option value="Bursar">Bursar</option>
					<option value="Career Development Services">Career Development Services</option>
					<option value="Compliance, Training, and Community Relations">Compliance, Training, and Community Relations</option>
					<option value="Computer Operations and Production Services">Computer Operations and Production Services</option>
					<option value="Computing Sciences, College of">Computing Sciences, College of</option>
					<option value="Continuing Professional Education">Continuing Professional Education</option>
					<option value="Custodial Services">Custodial Services</option>
					<option value="Department of Aerospace Studies (AFROTC)">Department of Aerospace Studies (AFROTC)</option>
					<option value="Department of Biomedical Engineering">Department of Biomedical Engineering</option>
					<option value="Department of Chemistry and Environmental Science">Department of Chemistry and Environmental Science</option>
					<option value="Department of Civil and Environmental Engineering">Department of Civil and Environmental Engineering</option>
					<option value="Department of Computer Science">Department of Computer Science</option>
					<option value="Department of Electrical and Computer Engineering">Department of Electrical and Computer Engineering</option>
					<option value="Department of Engineering Technology">Department of Engineering Technology</option>
					<option value="Department of Humanities">Department of Humanities</option>
					<option value="Department of Information Systems">Department of Information Systems</option>
					<option value="Department of Mathematical Sciences">Department of Mathematical Sciences</option>
					<option value="Department of Mechanical & Industrial Engineering�">Department of Mechanical & Industrial Engineering�</option>
					<option value="Department of Physics">Department of Physics</option>
					<option value="Development">Development</option>
					<option value="Economic Development">Economic Development</option>
					<option value="Educational Opportunity Program">Educational Opportunity Program</option>
					<option value="Engineering, Newark College of">Engineering, Newark College of</option>
					<option value="Enrollment Services">Enrollment Services</option>
					<option value="Environmental Health and Safety">Environmental Health and Safety</option>
					<option value="Faculty Council">Faculty Council</option>
					<option value="Federated Department of Biological Sciences">Federated Department of Biological Sciences</option>
					<option value="Federated Department of History">Federated Department of History</option>
					<option value="Finance and Controller's Offices">Finance and Controller's Offices</option>
					<option value="First Year Students">First Year Students</option>
					<option value="Graduate Studies">Graduate Studies</option>
					<option value="Grants and Contracts">Grants and Contracts</option>
					<option value="Health Services">Health Services</option>
					<option value="Honors College, Albert Dorman">Honors College, Albert Dorman</option>
					<option value="Human Resources">Human Resources</option>
					<option value="Information Services and Technology Division">Information Services and Technology Division</option>
					<option value="Institutional Research and Planning">Institutional Research and Planning</option>
					<option value="Instructional Technology">Instructional Technology</option>
					<option value="International Students">International Students</option>
					<option value="Management, School of">Management, School of</option>
					<option value="Media Services">Media Services</option>
					<option value="Online Learning">Online Learning</option>
					<option value="Otto H. York Department">Otto H. York Department</option>
					<option value="Payroll">Payroll</option>
					<option value="Physical Plant">Physical Plant</option>
					<option value="Pre-College Programs">Pre-College Programs</option>
					<option value="President">President</option>
					<option value="Provost">Provost</option>
					<option value="Public Safety">Public Safety</option>
					<option value="Purchasing and Office Services">Purchasing and Office Services</option>
					<option value="Residence Life">Residence Life</option>
					<option value="Science and Liberal Arts, College of">Science and Liberal Arts, College of</option>
					<option value="Special Events">Special Events</option>
					<option value="Sponsored Programs (Research Office)">Sponsored Programs (Research Office)</option>
					<option value="Strategic Communications">Strategic Communications</option>
					<option value="Student Services">Student Services</option>
					<option value="Technology Development">Technology Development</option>
					<option value="Telecommunications and Networks">Telecommunications and Networks</option>
					<option value="University Advancement">University Advancement</option>
					<option value="University Audits">University Audits</option>
					<option value="University Communications">University Communications</option>
					<option value="University Computing Systems">University Computing Systems</option>
					<option value="University Counsel">University Counsel</option>
					<option value="University Information Systems">University Information Systems</option>
					<option value="Van Houten Library">Van Houten Library</option>
					</select>
					               
               
           </li>
           <li>
               <label for="name">Would you be interested in learning about Service Learning on NJIT?</label>
               <select name="servelearn">
                   <option value=""></option>
                   <option value="yes">Yes</option>
                   <option value="no">No</option>
               </select>
           </li>
       </fieldset>
   </ul>
</div>
<div id="organizations">
   <ul>
       <fieldset>
           <h2>Organization Information</h2>
           <li>
               <label for="name">Organization Name</label>
               <input type="text" name="organizationName"/>
           </li>
           <li>
           
               <label for="name">Website URL</label>
               <input type="text" name="organizationWebsite"/>
           </li>
           <li>
               <label for="name">Description</label>
               <textarea cols="10" rows="10" name="organizationDescription"> </textarea>
           </li>
           <li>
               <label for="name">Phone Number</label>
               <input type="text" name="o_phone"/>
           </li>
           <li>
               <label for="name">Mailing Address</label>
               <textarea cols="10" rows="10" name="organizationAddress"> </textarea>
           </li>
           <li>
               <label for="name">Agency Type</label>
               <textarea cols="10" rows="10" name="agencyType"> </textarea>
           </li>       
       </fieldset>
   </ul>
</div> 



 	
<div id="submitBttn">
<?php echo recaptcha_get_html($publickey); ?>


<input type="submit" value="Submit">
</div>





</ul>

   </form>
</div>
<script>
   $(document).ready(function(){

   $("#students").hide();

   $("#contactInfo").hide();
   $("#njitStudent").hide();
   $("#njit-fac").hide();
   $("#organizations").hide();

   $("#userCred").hide();
   $("#submitBttn").hide();
   $("#nonNJITStudent").hide();
   $("#userConfirm").hide();



   $('#accountType').bind('change', function (e) { 

       if( $('#accountType').val() == 'NJITStudent') {

           //HIDE
   	 $("#nonNJITStudent").slideUp();
   	   $("#njit-fac").slideUp();
           $("#organizations").slideUp();

           //SHOW
           $("#contactInfo").slideDown();
           $("#njitStudent").slideDown();
   	 $("#userCred").slideDown();
   	
   	
   	 //ALWAYS THERE
   	 $("#userConfirm").slideDown();
   	 $("#submitBttn").slideDown();

           
           
       } else if ($('#accountType').val() == 'NonNJITStudent') {
   	   
   	   //HIDE
   	    $("#njitStudent").slideUp();
           $("#njit-fac").slideUp();
           $("#organizations").slideUp();
      
   	   
   	   //SHOW
   	 $("#contactInfo").slideDown();
   	 $("#nonNJITStudent").slideDown();
   	
   	
   	 //MUST BE THERE
   	 $("#userConfirm").slideDown();
   	 $("#submitBttn").slideDown();

       

       } else if ($('#accountType').val() == 'FacultyStaff') {
          
          //HIDE
           $("#njitStudent").slideUp();
           $("#nonNJITStudent").slideUp();
           $("#organizations").slideUp();
          
          //SHOW
          $("#contactInfo").slideDown();
           $("#njit-fac").slideDown();
           
           
           //MUST BE THERE
           $("#userConfirm").slideDown();
           $("#submitBttn").slideDown();



       }   else if ($('#accountType').val() == 'Organization') {
          
          //HIDE
           $("#njitStudent").slideUp();
           $("#nonNJITStudent").slideUp();
           $("#njit-fac").slideUp();
           $("#contactInfo").slideUp();
          
          //SHOW
           $("#contactInfo").slideDown();
           $("#organizations").slideDown();
           
           
           //MUST BE THERE
           $("#userConfirm").slideDown();
           $("#submitBttn").slideDown();
       


       } else{
           $("#njitStudent").slideUp();
           $("#nonNJITStudent").slideUp();
           $("#njit-fac").slideUp();
           $("#contactInfo").slideUp();
          
          //SHOW
           $("#organizations").slideUp();
           
           
           //MUST BE THERE
           $("#userConfirm").slideUp();
           $("#submitBttn").slideUp();
       
       }
   	
   });//end of select change
     
     
     
    
   });


   $("#ListOne").click(function(){
       
       $("#students").slideDown();

   });



</script>







</script>
<?php

   include ('includes/footer.php');

?>