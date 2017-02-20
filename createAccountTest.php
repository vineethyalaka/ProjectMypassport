<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form method="POST" action="createAccountTest.php">
	<input type="password" name="password1"/>
    <input type="password" name="password2"/>
    <input type="submit" value="Submit" />
</form>
<?php
	if($_SERVER['REQUEST_METHOD'] == POST) {
		$submittedPassword = $_POST['password2'];
		echo $submittedPassword;
		
		if(preg_match('/^\w{8,20}$/', $submittedPassword)) {
			//$n_password = $submittedPassword;
			echo 'good password';
		} else {
			echo '<p>Bad password</p>';
		}
		
		if('^[A-Z]{8,}$') {
				
		} else {
		
		}
		
		
	} //end if
?>
</body>
</html>