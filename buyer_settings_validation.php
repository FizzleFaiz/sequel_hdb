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
$id = $_SESSION['id'];

$pwdErr = $pwdcfmErr = $oldpwdErr =  $incomeErr = "";
$pwdStyle = $pwdcfmStyle = $oldpwdStyle = $incomeStyle = "text-align: left; color: black";
 $oldValid = $passwordValid = $password1Valid = true;
 $cfmMsg = "";

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(!empty($_POST['oldpass']) && !empty($_POST['pwd1']) && !empty($_POST['pwd2'])){
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
                }
                
                $income = test_input($_POST["income"]);
                //check income
                if (!is_numeric($income)){
                    $incomeErr = "Should only contain digits";
                    $incomeStyle = "text-align:left; color:red;";
                }
                if($oldValid == true && $passwordValid == true && $password1Valid == true && $incomeErr == ""){
                    if(!empty($_POST['oldpass']) && !empty($_POST['pwd1']) && !empty($_POST['pwd2'])){
                        $pwdSQL = mysqli_real_escape_string($conn,$_POST['pwd1']);
                    }
                    $pwdSQL = $_SESSION['pwd'];
                    $marriedSQL = mysqli_real_escape_string($conn,$_POST['married']);
                    $parentLocSQL = mysqli_real_escape_string($conn,$_POST['parentLoc']);
                    $citizenSQL = mysqli_real_escape_string($conn,$_POST['citizen']);
                    $incomeSQL = (int)mysqli_real_escape_string($conn,$_POST['income']);
                    $sql= "UPDATE buyer SET password ='".$pwdSQL."', married ='".$marriedSQL."', parentLocation = '".$parentLocSQL."', citizenship = '".$citizenSQL."'"
                            . ", income = '".$incomeSQL."' WHERE email='".$id."' AND verified='1' ";
                    
                    if (!mysqli_query($conn,$sql)) {
                    die('Error: ' . mysqli_error($conn));
                    }
                     else {
                         
                         $_SESSION['pwd'] = $pwdSQL;
                         $cfmMsg= "Details has been updated";  
                     }
                     
                    
                }
                
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }