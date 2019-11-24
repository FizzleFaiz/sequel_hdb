<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
$dsn = "rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com";
//$dsn = "gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com";
$dbuser = "1801148MFR";
$dbpwd = "19ICT2103";
$db ="1801148mfr";
$conn = mysqli_connect($dsn, $dbuser, $dbpwd, $db);
$houseId = mysqli_real_escape_string($conn,$_SESSION['houseDetails']);
$searchHouse = mysqli_query($conn,"SELECT * FROM resale_putup WHERE resaleId ='".$houseId."'") or die(mysqli_error($conn));
$searchedHouse = mysqli_fetch_array($searchHouse);

?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width">
        <title><?php echo $searchedHouse['resaleId']." ".$searchedHouse['town'];?></title>
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
        <div class="card" style="margin-left:auto; margin-right:auto; width:80%; top:15%; margin-bottom: 10px;">
            <!-- Title of Current Webpage -->
            
            <h1 class="title"><?php echo $searchedHouse['resaleId']." ".$searchedHouse['town'];?></h1>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <img src="img/BTO_IMAGE.jpg"style=" height:auto; width:100%;">
                    </div>
                    <div class="col-md-6" style="border-right: 1px dashed lightgrey;">
                        <p>Resale Price: $<?php echo floatval($searchedHouse['resalePrice']);?></p>
                        <p>Address: <?php echo $searchedHouse['block']." ".$searchedHouse['streetName'];?></p>
                        <p>Flat Type: <?php echo $searchedHouse['flatType'];?></p>
                        <p>Flat Model: <?php echo $searchedHouse['flatModel'];?></p>
                        <p>Floor Area: <?php echo $searchedHouse['floorArea'];?> sqft</p>
                    </div>
                    <div class="col-md-6">
                        <p> RAJ THIS SPACE IS FOR YOU </p>
                    </div>
                    <div class="col-md-12" style="padding-top:10px;">
                        <button style="margin: 0 auto; width:100%; border-radius: 12px; background-color:yellow; font-family: Roboto;"><b>Interested? Click Here</b></button>
                    </div>
                </div>
                
            </div>               
        </div>
    </body>
</html>