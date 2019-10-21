<?php

include 'connection.php'
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Verification Page</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    <link href="css/verify.css" rel="stylesheet" type="text/css"/>
    
    
</head>
<body>
    <?php
    if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['code']) && !empty($_GET['code'])){
	// Verify data
	$email = mysqli_escape_string($conn,$_GET['email']); // Set email variable
	$code = mysqli_escape_string($conn,$_GET['code']); // Set hash variable
        $search = mysqli_query($conn,"SELECT email, hash, verified FROM buyer WHERE email='".$email."' AND hash='".$code."' AND verified='0'") or die(mysqli_error($conn));
        $match = mysqli_num_rows($search);
	
			
	if($match > 0){
		// We have a match, activate the account
		mysqli_query($conn,"UPDATE buyer SET verified='1' WHERE email='".$email."' AND hash='".$code."' AND verified='0'") or die(mysqli_error($conn));
		echo '<div class="statusmsg">Your account has been activated, you can now login</div>'
                . '<a href="login_form.php"><button>Click here to Login</button></a>';
	}else{
		// No match -> invalid url or account has already been activated.
		echo '<div class="statusmsg">The url is either invalid or you already have activated your account.</div>';
	}
				
        }else{
                // Invalid approach
                echo '<div class="statusmsg">Invalid approach, please use the link that has been send to your email.</div>';
        }
    ?>
    
</body>
</html>