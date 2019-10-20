<?php

/*
 * Change the servername according to ur settings
 * in mySQL database
 * 
 */
$servername = "";
$user = "";
$password = "";
$conn = mysqli_connect($servername, $user, $password, $db);
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//SMTP Username and password which will host this gmail as a temporary server to send email to recipients
define('SMTP_USER', 'teamsequelhdb@gmail.com');
define('SMTP_PASS', 'Sequel2103');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';



                $nameErr = $emailErr = $dobErr = $pwdErr = $pwdcfmErr = "";
                $nameStyle = $emailStyle = $dobStyle = $pwdStyle = $pwdcfmStyle = "text-align: left; color: black";
                
                if($_SERVER["REQUEST_METHOD"] == "POST")
                {
                    /* 
                     * Validation checking onwards
                     * 
                     */
                    
                    $name = test_input($_POST["name"]);
                    if (!preg_match("/^[a-z ,.'-]+$/i",$name) || strlen( $name) <4)
                    {
                        $nameErr = "Name should be at least 4 characters long";
                        $nameStyle = "text-align:left; color:red;";
                    }
                    //Checking birthdate validation
                    $birthdate = test_input($_POST["dob"]);
                    if(!validateAge($birthdate))
                    {
                        $dobErr = "Only users of the age of 18 can enter this site";
                        $dobStyle = "text-align:left; color:red;";
                    }
                    
                    $email = test_input($_POST["email"]);
                    // check if e-mail address is well-formed
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
                    {
                        $emailErr = "Invalid email format";
                        $returnStyle2 = "text-align:left; color:red;";
                    }
                    // Checking if password meet minimum requirements
                    $pwd1 = test_input($_POST["pwd1"]);
                    if ( !preg_match( '/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $pwd1) || strlen( $pwd1) < 6)
                    {
                        $pwdErr = "Invalid password, please enter alphanumeric with at least 6 characters";
                        $pwdStyle = "text-align:left; color:red;";
                    }
            
                    // Checking if password meet minimum requirements
                    $pwd2 = test_input($_POST["pwd2"]);
                    if ( !preg_match( '/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $pwd2) || strlen( $pwd2) < 6)
                    {
                        $pwdcfmErr = "Invalid password, please enter alphanumeric with at least 6 characters";
                        $pwdcfmStyle = "text-align:left; color:red;";
                    }
                    
                    /* Checking if password and cfm password is same*/
                    if($pwd1 != $pwd2)
                    {
                        $pwdErr = "Make sure both passwords are the same";
                        $pwdStyle = "text-align:left; color:red;";
                        $pwdcfmErr = "Make sure both passwords are the same";
                        $pwdcfmStyle = "text-align:left; color:red;";
                    } 
                    
                    // if no errors
                    if($nameErr == "" && $dobErr == "" && $emailErr == "" && $pwdErr == "" && $pwdcfmErr == "")
                    {
                        
                        
                        //Server name with name and pass
                        //Escape Variables to prevent SQL injection
                        $nameSQL = mysqli_real_escape_string($conn,$POST['name']);
                        $ageSQL = changetoAge(mysqli_real_escape_string($conn,$POST['dob']));
                        $marriedSQL = mysqli_real_escape_string($conn,$POST['married']);
                        $parentLocSQL = mysqli_real_escape_string($conn,$POST['parentLoc']);
                        $citizenSQL = mysqli_real_escape_string($conn,$POST['citizen']);
                        $incomeSQL = mysqli_real_escape_string($conn,$POST['income']);
                        $ftSQL = mysqli_real_escape_string($conn,$POST['firsttime']);
                        $pwdSQL = mysqli_real_escape_string($conn,$POST['pwd1']);
                        $emailSQL = mysqli_real_escape_string($conn,$POST['email']);
                        $code = md5(rand(0,1000)); //Generate random 32 character has and assign it

                        
                        $sql = "INSERT INTO buyer (name,age,married,parentLocation,citizenship,income,firstTime,password,email,hash)"
                                . "VALUES ('$nameSQL','$ageSQL','$marriedSQL','$parentLocSQL','$citizenSQL',$incomeSQL','$ftSQL','$pwdSQL','$emailSQL')";
                    }
                    
                    //Sending email verification
                   $mail = new PHPMailer;
                   $mail->isSMTP();
                   $mail->SMTPAuth = true;
                   $mail->SMTPSecure = 'ssl';
                   $mail->Host = "smtp.gmail.com";
                   $mail->Port = '465';
                   $mail->isHTML();
                   $mail->Username = SMTP_USER;  
                   $mail->Password = SMTP_PASS;
                   $mail->setFrom(SMTP_USER);
                   $mail->Subject  = 'Signup | Verification';
                   $mail->Body     = '

                   Thanks for signing up!
                   Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.

                   <p>------------------------</p>
                   <p>Full Name: '.$nameSQL.'</p> 
                   <p>Password: '.$pwdSQL.'</p>
                   <p>------------------------</p>

                   Please click this link to activate your account:
                   http://localhost/Sequel_HDB/verify.php?email='.$emailSQL.'&code='.$code.'

                   ';
                   $mail->addAddress($emailSQL);

                   if(!$mail->send()) 
                   {


                      echo '<div style="background-color:white;text-align:center;font-size: 40px;padding: 10px 10px 10px 10px">Message was not sent.';
                      echo 'Mailer error: ' . $mail->ErrorInfo . '</div>';
                    } else {

                      echo '<div style="background-color:white;text-align:center;font-size: 30px;padding: 10px 10px 10px 10px">Email has been sent for verification.'
                        . 'Please check your spam/junk folder if needed</div>'
                              . '<a href="login_form.php"><button>Click here to Login</button></a>';
                    }
                
                
                }
                
                function test_input($data) {
                  $data = trim($data);
                  $data = stripslashes($data);
                  $data = htmlspecialchars($data);
                  return $data;
                 }
                 //Checking if age is allowed
                function validateAge($birthday, $age = 18, $age1 = 130)
                {
                    // $birthday can be UNIX_TIMESTAMP or just a string-date.
                    if(is_string($birthday)) {
                        $birthday = strtotime($birthday);
                    }

                    // check
                    // 31536000 is the number of seconds in a 365 days year.
                    if(time() - $birthday < $age * 31536000)  {
                        return false;
                    }
                     else if(time() - $birthday > $age1 * 31536000){
                        return false;
                    }

                    return true;
                }
                //Changing date of birth to age
                function changetoAge($dob)
                {
                    $date = new DateTime($dob);
                    $now = new DateTime();
                    $age = $now->diff($date);
                    
                    return $age;
                }
                        
    

