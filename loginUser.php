<?php

include ('includes/functions.php');
include ('includes/header.php');

$page_title = 'CECC Login';

$ac1 = $_GET['acc'];



session_start();

if ( $_SESSION['email'] != '' ){
    print '<h2 text-align="center"> You are already logged in. Click <a href="/application/"> here</a> to get back.</h2>';
    include ('includes/footer.php');
    exit(); 
}


?>



<p>Please use your email as your username and enter the password that was provided to you in your 
    email. Then select select the account type that you have registered for.</p>

<form method="post" action="includes/sessionController.php">
        <table>
            <tr>
                <td><label>NJIT / Primary Email </label></td>
                <td><input style="text" id="loginUsername" name="loginUsername" required autofocus /></td>
            </tr>
            
            <tr>
                <td><label>Password</label></td>
                <td><input type="password" id="loginPassword" name="loginPassword"required  /></td>
            </tr>
            
            <!-- <tr>
                <td><label>Account Type</label></td>
                <td>
                    <select required name="accountType">
                        <option value="<? echo $ac1; ?>"><? echo $ac1; ?></option>    
                        <option value="NJITStudent">Student</option>
                        <option value="NonNJITStudent">NON - NJIT Student</option>
                        <option value="FacultyStaff">Faculty/Staff</option>
                        <option value="organization">Organization</option>
                        <option value="admin">Administration</option>
                                       </select>
        
                </td>
            </tr>
            
            -->
            
            <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit" /></td>
            </tr>
            
        </table>
    </fieldset>
</form>       
<h2><a href="passwordRecovery.php">Lost / Forgot Password ?</a> </h2>     
<?php
include ('includes/footer.php');
?> 