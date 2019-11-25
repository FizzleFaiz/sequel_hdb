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
//try{
//    $conn = mysqli_connect($dsn, $dbuser, $dbpwd, $db);
//    $conn = new PDO("mysql:host=$dsn;port=3306;dbname=$db","$dbuser","$dbpwd",array(PDO::ATTR_PERSISTENT =>true));
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connected successfully";
//} catch (PDOException $e) {
//{
//    echo "Connection failed: ".$e->getMessage();
//
//}
//
//}



        $loginErr = "";
        $loginStyle = "display: none";
        
        $emailStyle = $pwdStyle = "text-align: left; color: black";
        $emailErr = $pwdErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pwd']) && !empty($_POST['pwd'])){
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $password = mysqli_real_escape_string($conn,$_POST['pwd']);
                $group = mysqli_real_escape_string($conn,$_POST['group']);
                if($group === 'buyer'){
                    $search = mysqli_query($conn,"SELECT * FROM buyer WHERE email ='".$email."' AND password='".$password."' AND verified =1") or die(mysqli_error($conn));
                    $_SESSION['type'] = '1';
                }

                if($group === 'agent'){
                     $isAgent = 'SELECT isAgent FROM seller where sellerId ="'.$email.'"';
                     $searchAgent = mysqli_query($conn,$isAgent) or die(mysqli_error($conn));
                     $row = mysqli_fetch_array($searchAgent);
                     $value = $row[0];
                     $_SESSION['seller'] = $value;
                     $_SESSION['type'] = '2';
                     $search = mysqli_query($conn,"SELECT * FROM seller WHERE sellerId ='".$email."' AND password='".$password."'") or die(mysqli_error($conn));
                }
                
                    
                
                $match = mysqli_num_rows($search);
                
                if($match > 0){
                    $_SESSION['id'] = mysqli_real_escape_string($conn,$_POST['email']);
                    $_SESSION['pwd'] = mysqli_real_escape_string($conn,$_POST['pwd']);
                    header('Location: main.php');
                }
                else{
                    $loginStyle = "text-align:left; color:red;";
                    $loginErr = 'Login Failed! Please make sure that you entered the correct details and that you have activated your account.';
                        
                }
            }
            if(empty($_POST['email'])){
                $emailErr = "Please enter your email";
                $emailStyle = "text-align:left; color:red;";
            }
            if(empty($_POST['pwd'])){
                $pwdError = "Please enter your password";
                $pwdStyle = "text-align:left; color:red;";
            }
        }

