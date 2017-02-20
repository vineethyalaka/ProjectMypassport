<?php
$page_title = 'Welcome';

include ('includes/header.php');


?>
<style type="text/css">
.form-style-1 {
    margin:10px auto;
    max-width: 400px;
    padding:5px;
    font: 13px "Lucida Sans Unicode", "Lucida Grande", sans-serif;
}
.form-style-1 li {
    padding: 0;
    display: block;
    list-style: none;
    margin: 10px 0 0 0;
}
.form-style-1 label{
    margin:0 0 3px 0;
    padding:0px;
    display:block;
    font-weight: bold;
}
.form-style-1 input[type=text], 
.form-style-1 input[type=date],
.form-style-1 input[type=datetime],
.form-style-1 input[type=number],
.form-style-1 input[type=search],
.form-style-1 input[type=time],
.form-style-1 input[type=url],
.form-style-1 input[type=email],
textarea, 
select{
    box-sizing: border-box;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    border:1px solid #BEBEBE;
    padding: 7px;
    margin:0px;
    height: 20px;
    -webkit-transition: all 0.30s ease-in-out;
    -moz-transition: all 0.30s ease-in-out;
    -ms-transition: all 0.30s ease-in-out;
    -o-transition: all 0.30s ease-in-out;
    outline: none;  
}
.form-style-1 input[type=text]:focus, 
.form-style-1 input[type=date]:focus,
.form-style-1 input[type=datetime]:focus,
.form-style-1 input[type=number]:focus,
.form-style-1 input[type=search]:focus,
.form-style-1 input[type=time]:focus,
.form-style-1 input[type=url]:focus,
.form-style-1 input[type=email]:focus,
.form-style-1 textarea:focus, 
.form-style-1 select:focus{
    -moz-box-shadow: 0 0 8px #88D5E9;
    -webkit-box-shadow: 0 0 8px #88D5E9;
    box-shadow: 0 0 8px #88D5E9;
    border: 1px solid #88D5E9;
}
.form-style-1 .field-divided{
    width: 49%;
}

.form-style-1 .field-long{
    width: 100%;
}
.form-style-1 .field-select{
    width: 100%;
}
.form-style-1 .field-textarea{
    height: 100px;
}
.form-style-1 input[type=submit], .form-style-1 input[type=button]{
    background: #8d0904;
    padding: 8px 15px 8px 15px;
    border: none;
    color: #fff;
}
.form-style-1 input[type=submit]:hover, .form-style-1 input[type=button]:hover{
    background: #30354b;
    box-shadow:none;
    -moz-box-shadow:none;
    -webkit-box-shadow:none;
}
.form-style-1 .required{
    color:red;
}
</style>




		<aside id="sidebar" style="margin-right:0px;border-radius: 5px;margin-top: 7.5%;">     
        <!-- START call out if any -->  
            <div class="callout">
            <h3><strong>Login To MyPassport</h3></strong>
            <ul class="form-style-1">
                <form method="post" action="includes/sessionController.php">
                    <li>
                    <label></label>
                    <input  onblur="if (this.value == '') {this.value = 'NJIT/Primary Email ID';}" onfocus="this.value = '';" style="font-family: &quot;Open Sans&quot;,sans-serif; border-radius: 4px; height: 20px; border: 2px solid rgb(191, 183, 183);color: rgb(131, 115, 115);margin-bottom:10px;" class="field-long" id="loginUsername" name="loginUsername" required="" autofocus=""></li>
                    
                    <li><label></label>
                    <input type="password" onblur="if (this.value == '') {this.value = 'Password';}" onfocus="this.value = '';" style="font-family: &quot;Open Sans&quot;,sans-serif; border-radius: 4px; height: 20px; border: 2px solid rgb(191, 183, 183);color: rgb(131, 115, 115);margin-bottom:10px;" class="field-long" id="loginPassword" name="loginPassword" required="" autofocus="">
                    </li>
                    Do not have an account?<br/>
                    <a href="/mypassport/createAccount.php" >Create your account and Start Volunteering today </a> 
                    
                   <li><input type="submit" name="submit" value="Submit" style="border-radius: 6px;" /></li>
                        
            
    
        </aside><!-- end of sidebar -->
        
			<h1><strong>Welcome</strong></h1>
		
            <H2 style="text-align: justify;">
            At NJIT, we are committed to fostering opportunities for students to share their skills, talents and enthusiasm through service for the benefit of our communities.  Through the civic engagement programs, our students have become an invaluable resource of both technical and non-technical help for local and regional agencies.  We link students, alumni, faculty, and staff directly to community service activities with non-profit organizations located in and around Newark and throughout the state of New Jersey.
            </H2>

            <!--
            <a href="students.php">
                    <h2>Students</h2>
                    <img class="center" width="250px" height="160px" />
            </a>
            </td>
                
            
            <td> <!---original faculty/staff-->
            
            <!--
            <a href="alumni.php">
                <h2>Alumni</h2>
                <img  width="200px" height="160px" />
           </a>
           </td>
       </tr>
           <!---new Staff-->
       <!--
       <tr>
           <td>
                <a href="faculty.php">
                <h2>Faculty / Staff</h2>
                <img  height="160px" />
           		</a>
           </td>
       
     		<td>
                <a href="organizations.php">
                <h2>Community Organizations</h2>
                <img  width="200px" height="160px" />
            	</a>
                -->
            </td>
		</tr>
</table>

            <blockquote>
        
                <p>If you really want to stand out from the crowd and be recognized by society, 
                    then it is the quality of contribution which you make to others that counts.</p>
                    
        
                <p class="cite"><cite>by Wynona Lipman (Former NJ State Senator)</cite></p>
      
            </blockquote>
            



<?php 
include ('includes/footer.php');


?>