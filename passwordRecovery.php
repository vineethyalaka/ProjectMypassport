<?php
		require 'includes/classes/Autoloader.php';

include ('includes/functions.php');
include ('includes/header.php');
//include ('includes/check_session.php');  

$page_title = 'CECC Login';


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $rAccount = $_POST['accountType'];
    $rUsername = $_POST['loginUsername'];
    

    
    $sql = "SELECT * FROM civic_users
                WHERE email = '$rUsername' AND acct_type = '$rAccount'";
                
    $u_id = mysql_query( "SELECT id FROM civic_users
                WHERE email = '$rUsername' AND acct_type = '$rAccount' ");
    
  $row = mysql_fetch_array($u_id);

           
    $result = mysql_query( $sql );
             
    $count = mysql_num_rows( $result );
    
    $newpass = passwordGenerator(8);
                
    if ($count >= 1) {
	    
	   	mysql_query ("INSERT INTO civic_password_recovery (user_id, date_created) VALUES (" . $row['id'] . ", NOW() )");

        
        echo '<br />';

        // Message Body
        $message = '<h1> Hello ' . $rUsername . '</h1>';
        $message .= 'You have recently lost your MyPassport Account password.
                        The most recent information  is listed below.' ;
        $message .= '<p>Your username is: ' .  $rUsername . '.<br>';
        $message .= 'Your new password is: '. $newpass . '<br>Thanks.</p>';
        $message .= 'You can login here: http://www.njit.edu/cds/civic/mypassport.</p>';


        $res = mailer( "Password Recovery", $message );

        //Recipients
        $to = $rUsername;

        //Subject Line
        $subject = "Civic Engagement @ NJIT - Lost / Forgot Password";

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: cecc@njit.edu <cecc@njit.edu>' . "\r\n";

        // Send the Email

        $send = mail($to, $subject, $res, $headers);


        if ( $send ){

            echo '<div class="success"> Please check your email at ' . $rUsername . ' for your new password.</div>';
            
            $update = "UPDATE civic_users SET password = SHA1('$newpass') 
                        WHERE email = '$rUsername' AND acct_type = '$rAccount'";
									
            

            
            
            $updateQuery = mysql_query($update);
			
			print '<script> setTimeout("location.href = "loginUser.php", 300); </script>';
            

        } else {

            echo "Mail Sending Failed";

        }
        
    } else {
        
        print '<div class="error">The information your provided is either incorrect or does not match our systems. Please use the Contact Us form for more assistance. </div>';
    }
    
    
    




} else {
    
    
    
}







?>


<h1>Password Recovery</h1>

<form class="contact_form" method="post" action="passwordRecovery.php">
        <table>
            <tr>
                <td><label>Account Type</label></td>
                <td>
                    <select name="accountType"> Choose One
                        <option value="default">Select</option>    
                        <option value="NJITStudent">Student</option>
                        <option value="NonNJITStudent">Non-NJIT Student</option>
                        <option value="FacultyStaff">Faculty / Staff</option>
                        <option value="organization">Organization</option>

                    </select>
                </td>
            </tr>
            <tr>
                <td><label>Username</label></td>
                <td><input style="text" id="loginUsername" name="loginUsername" autofocus /></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            
        </table>
    </fieldset>
</form>


     

<?php
include ('includes/footer.html');
?> 