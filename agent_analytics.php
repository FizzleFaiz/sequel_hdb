<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connection.php';
if( isset($_SESSION["id"]) &&  isset($_SESSION["pwd"]) ){
    $email = $_SESSION['id'];
    $password = $_SESSION['pwd'];
    // Buyer
    if($_SESSION['type']=='1'){
        $sql = mysqli_query($conn,"SELECT name FROM buyer WHERE email='".$email."' AND password='".$password."' AND verified='1'") or die(mysqli_error($conn));
    }
    // Seller
    if($_SESSION['type']=='2'){
        $sql = mysqli_query($conn,"SELECT name FROM seller WHERE sellerId='".$email."' AND password='".$password."' AND isAgent='1'") or die(mysqli_error($conn));
    }
    $row = mysqli_fetch_array($sql);
    $name = $row[0];
    $_SESSION['name'] = $name;
}
else{
    $_SESSION['type'] = '0';
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>House Popularity</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php 
        if ($_SESSION['type']  == '0'){
            include 'menu.php'; 
        }
        if ($_SESSION['type']  == '1'){
            include 'menu-buyer.php'; 
        }
        if ($_SESSION['type']  == '2'){
            include 'menu-agent.php'; 
        }
        
        ?>
        <!-- Outermost container containing content -->
        <div class="container col-md-10 col-10 col-lg-10" style="top:15%;">
            <!-- Title of Current Webpage -->
            <h1 class="title">House Popularity</h1>
            <!-- Populate the table -->
            
            
        </div>
        <link href="tables/datatables.css" rel="stylesheet" type="text/css"/>
        <script src="tables/datatables.js" type="text/javascript"></script>
        <link href="tables/css/dataTables.jqueryui.css" rel="stylesheet" type="text/css"/>
        <script src="tables/js/dataTables.jqueryui.js" type="text/javascript"></script>
<!--        <link href="tables/css/jquery.dataTables.css" rel="stylesheet" type="text/css"/>
        <script src="tables/js/jquery.dataTables.js" type="text/javascript"></script>-->
        <link href="tables/css/buttons.bootstrap.css" rel="stylesheet" type="text/css"/>
        <script src="tables/js/buttons.bootstrap.js" type="text/javascript"></script>
        <!-- Button -->
        <link href="tables/css/buttons.bootstrap4.css" rel="stylesheet" type="text/css"/>
        <link href="tables/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css"/>
        <script src="tables/js/buttons.bootstrap4.min.js" type="text/javascript"></script>
        <link href="tables/css/buttons.jqueryui.min.css" rel="stylesheet" type="text/css"/>
        <script src="tables/js/buttons.colVis.js" type="text/javascript"></script>
        <script src="tables/js/buttons.flash.js" type="text/javascript"></script>
        <script src="tables/js/buttons.foundation.js" type="text/javascript"></script>
        <script src="tables/js/buttons.html5.js" type="text/javascript"></script>
        <script src="tables/js/buttons.jqueryui.js" type="text/javascript"></script>
        <script src="tables/js/buttons.print.js" type="text/javascript"></script>
        <script src="tables/js/dataTables.buttons.js" type="text/javascript"></script>
        <script src="tables/js/jszip.js" type="text/javascript"></script>
        <script src="tables/js/pdfmake.js" type="text/javascript"></script>
        <script src="tables/js/vfs_fonts.js" type="text/javascript"></script>
        <a href="tables/swf/flashExport.swf"></a>
        <script>
       
        </script>
        
        
        
    </body>
</html>
