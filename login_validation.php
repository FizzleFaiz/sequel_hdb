<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$servername = "localhost";
$user = "root";
$password = "";
$db ="test";
$conn = mysqli_connect($servername, $user, $password, $db);

        $loginErr = "";
        $loginStyle = "display: none";
        
        $emailStyle = $pwdStyle = "text-align: left; color: black";
        $emailErr = $pwdErr = "";
        
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['pwd']) && !empty($_POST['pwd'])){
                $email = mysqli_real_escape_string($conn,$_POST['email']);
                $password = mysqli_real_escape_string($conn,$_POST['pwd']);
                
                $search = mysqli_query($conn,"SELECT * FROM buyer WHERE email ='".$email."' AND password='".$password."' AND verified =1") or die(mysqli_error($conn));
                $match = mysqli_num_rows($search);
                
                if($match > 0){
                    $_SESSION['email'] = mysqli_real_escape_string($conn,$_POST['email']);
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

