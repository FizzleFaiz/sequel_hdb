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
$pass = $_SESSION['password'];

$pwdErr = $pwdcfmErr = $oldpwdErr = "";
$pwdStyle = $pwdcfmStyle = $oldpwdStyle = "text-align: left; color: black";
 $oldValid = $passwordValid = $password1Valid = "";

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $oldpassword = test_input($_POST["oldpass"]);
                if($oldpassword === $pass){
                    $oldValid = false;
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
                
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }