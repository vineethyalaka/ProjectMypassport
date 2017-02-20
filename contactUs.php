<?php 

    $page_title = 'Contact Us';
    include ('includes/check_session.php');
    include ('includes/header.php');
    include ('includes/functions.php');

    session_start();

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
  
  
  }else{
	  
	  
  
  
	$s_njitEmail = mysql_real_escape_string($_POST['njitEmail']);
	$s_name = mysql_real_escape_string($_POST['name']);
	$s_secondEmail = mysql_real_escape_string($_POST['secondaryEmail']);
	$s_phoneNumber = mysql_real_escape_string($_POST['phoneNumber']);
	$s_message = $_POST['comment'];

	$facultyHeaders  = 'MIME-Version: 1.0' . "\r\n";
	$facultyHeaders .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
	$facultyHeaders .= 'From: '. $s_name . ' - ' . $s_njitEmail . '  <' . $s_njitEmail . '>' . "\r\n";

	$facultyMessage = '<div style="font-family:sans-serif;"><h1> ' . $s_name . '</h1>';
	$facultyMessage .= '<p>Has contacted us for help or feedback. Below is the message submitted.</p><hr />';
	$facultyMessage .= '<b>User ID:</b> ' . $_SESSION['user_id'] . '<hr />';
	$facultyMessage .= '<b>Account Type:</b> ' . $_SESSION['sessionType'] . '<hr />';
	$facultyMessage .= '<b>Name:</b> ' . $s_name . '<hr />';
	$facultyMessage .= '<b>NJIT Email Address:</b> ' . $s_njitEmail . '<hr />';
	$facultyMessage .= '<b>Secondary Email:</b> ' . $s_secondEmail . '<hr />';
	$facultyMessage .= '<b>Phone Number:  </b> ' . $s_phoneNumber . '<hr />';
	$facultyMessage .= '<b>Message: <br /> </b> ' . $s_message . '<hr />';
	
	
	$facultyMessage  = mailer("Help Requested", $facultyMessage);	

	//Recipients
	$facultyTo = "cecc@njit.edu";

	//Subject Line
	$facultySubject = "Civic Engagement @ NJIT - " . $n_name . " Help Requested";
	
	// Send the Email
	$sendFacultyEmail = mail($facultyTo, $facultySubject, $facultyMessage, $facultyHeaders);

	if ( $sendFacultyEmail ){

		echo '<div class="success">Your message has been sent to the administration of CECC @ NJIT.</div>';
		include ('includes/footer.php');
		exit;
		
	} else {
	
		echo '<div class="error">Your message was not sent. Please either try again or come and visit us: Campbell Hall 4th & 5th Floors.</div>';
		include ('includes/footer.php');
		exit;
	}
	
	}}//end submit

?>

<p> Want to find out various volunteer opportunities? Or simply need help finding something on our site? Feel free to send us a message or stop by.</p>
<p> We are located in Campbell Hall 4th and 5th Floors.</p>

<div id="studentSignUp">
    <form class="contact_form"  method="post" name="contact_form" action="<?=$_SERVER['PHP_SELF']?>">

        <ul>

				<li>
					<label for="name">Name</label>
					<input type="text"  id="name" name="name" placeholder="Full Name" 
						value="<?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'];?>" required/>
				</li>
				<li>
					<label for="email">NJIT Email:</label>
					<input type="email" name="njitEmail" placeholder="john_doe@njit.edu" 
							value="<?php echo $_SESSION['email'];?>" required />
							<span class="form_hint">Proper format "UCID@njit.edu"</span>
				</li>
				<li>
					<label for="email">Secondary Email:</label>
					<input type="email" name="secondaryEmail" placeholder="john_doe@gmail.com" />
				</li>
				<li>
					<label for="phone">Phone Number</label>
					<input type="phone" name="phoneNumber" />
				</li>
				<li>
					<label for="name">Message:</label>
					<textarea rows="10" cols="10" id="comment" name="comment"></textarea>
				</li>

			</ul>
		




<div id="submitBttn">
<?php echo recaptcha_get_html($publickey); ?>


<input type="submit" value="Submit">
</div>


</fieldset>
    </form>
</div>

<?php     include ('includes/footer.php');   ?>
