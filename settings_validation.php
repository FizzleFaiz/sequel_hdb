<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$dsn = "rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com";
//$dsn = "gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com";
$dbuser = "1801148MFR";
$dbpwd = "19ICT2103";
$db ="1801148mfr";
$conn = mysqli_connect($dsn, $dbuser, $dbpwd, $db);
$pass = $_SESSION['pwd'];
$seller = $_SESSION['seller'];
$id = $_SESSION['id'];

$pwdErr = $pwdcfmErr = $oldpwdErr = "";
$pwdStyle = $pwdcfmStyle = $oldpwdStyle = "text-align: left; color: black";
 $oldValid = $passwordValid = $password1Valid = "";
 $cfmMsg = "";

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $oldpassword = test_input($_POST["oldpass"]);
                if($oldpassword === $pass){
                    $oldValid = true;
                }
                else{
                    $oldpwdErr = "Invalid old password. Please enter the correct details.";
                    $oldValid = false;
                }
                
                $password = test_input($_POST["pwd1"]);
                $password1 = test_input($_POST["pwd2"]);
                if(!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}$/", $password)){
                        $pwdErr = "Password should contain at least 1 number,1 lowercase, 1 uppercase and 6 characters long.";
                        $passwordValid = false;
                    }
                else{
                        $passwordValid = true;
                }
                if($password !== $password1){
                    $pwdcfmErr = "Password does not match.";
                    $password1Valid = false;
                }
                else{
                    $password1Valid = true;
                }
                if($oldpassword == $password || $oldpassword == $password1){
                        $pwdErr = "New password cannot be old password";
                        $passwordValid = false;
                        
                        $pwdcfmErr = "New password cannot be old password";
                        $password1Valid = false;
                }
                if($oldValid == true && $passwordValid == true && $password1Valid == true){
                    $pwdSQL = mysqli_real_escape_string($conn,$_POST['pwd1']);
                    $sql= "UPDATE buyer SET password ='".$pwdSQL."' WHERE email='".$id."' AND verified='1' ";
                    if($seller == '0'){
                        $sql= "UPDATE seller SET password ='".$pwdSQL."' WHERE sellerId='".$id."' AND isAgent='0' ";
                    }
                    if($seller == '1'){
                        $sql= "UPDATE seller SET password ='".$pwdSQL."' WHERE sellerId='".$id."' AND isAgent='1' ";
                    }
                    
                    if (!mysqli_query($conn,$sql)) {
                    die('Error: ' . mysqli_error($conn));
                    }
                     else {
                         
                         $_SESSION['pwd'] = $pwdSQL;
                         $cfmMsg= "Password has been changed";  
                     }
                     
                    
                }
                
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }