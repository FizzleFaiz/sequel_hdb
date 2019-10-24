<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connection.php';
$email = $_SESSION['email'];
$password = $_SESSION['pwd'];
$sql = mysqli_query($conn,"SELECT name FROM buyer WHERE email='".$email."' AND password='".$password."' AND verified='1'") or die(mysqli_error($conn));
$row = mysqli_fetch_array($sql);
$name = $row[0];
$_SESSION['name'] = $name;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include 'menu.php' ?>
        <h1 class="title">Welcome <?php echo $_SESSION['name']; ?></h1>
        
        
        
        
    </body>
    <script src="js/menu_toggle.js" type="text/javascript"></script>
</html>
