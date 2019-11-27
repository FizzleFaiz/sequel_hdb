<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
define('SMTP_USER', 'teamsequelhdb@gmail.com');
define('SMTP_PASS', 'Sequel2103');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

session_start();
include 'connection.php';
$conn = mysqli_connect($dsn, $dbuser, $dbpwd, $db);
$houseId = mysqli_real_escape_string($conn,$_SESSION['houseDetails']);
$searchHouse = mysqli_query($conn,"SELECT * FROM resale_putup WHERE resaleId ='".$houseId."'") or die(mysqli_error($conn));
$searchedHouse = mysqli_fetch_array($searchHouse);
if( isset($_SESSION["id"]) &&  isset($_SESSION["pwd"]) ){
    $email = $_SESSION['id'];
    $password = $_SESSION['pwd'];
    // Buyer
    if($_SESSION['type']=='1'){
        $sql = mysqli_query($conn,"SELECT * FROM buyer WHERE email='".$email."' AND password='".$password."' AND verified='1'") or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($sql);
        $name = $row['name'];
        $buyerId = $row['buyerId'];
    }
    // Seller
    if($_SESSION['type']=='2'){
        $sql = mysqli_query($conn,"SELECT name FROM seller WHERE sellerId='".$email."' AND password='".$password."' AND isAgent='1'") or die(mysqli_error($conn));
        $row = mysqli_fetch_assoc($sql);
        $name = $row['name'];
    }
    
    $_SESSION['name'] = $name;
}
else{
    $_SESSION['type'] = '0';
}

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['buyerId']) && !empty($_POST['buyerId'])){
        mysqli_query($conn,"INSERT INTO buyer_housing VALUES('".$_POST['buyerId']."','".$_POST['resaleId']."', CURRENT_TIMESTAMP)") or die (mysqli_error($conn));
        $sql = mysqli_query($conn, "SELECT s.email from seller s, resale_putup rp where s.sellerId = rp.sellerId AND rp.resaleId ='".$_POST['resaleId']."'");
        $sellerEmail = mysqli_fetch_array($sql);  
        $mail = new PHPMailer;
        try {
            $mail->isSMTP();
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = '465';
            $mail->SMTPAutoTLS = false;
            
            
            $mail->Username = SMTP_USER;  
            $mail->Password = SMTP_PASS;
            $mail->setFrom(SMTP_USER);
            $mail->addAddress($sellerEmail[0]);
            $mail->Subject  = 'Interested Buyer In '.$_POST['resaleId'].' '.$_POST['resaleTown'];
            $mail->isHTML(true);
            $mail->Body     = '

            Hi,

            '.$row['name'].' is interested in '.$_POST['resaleId'].' '.$_POST['resaleTown'].'
            The contact details is:
            <p>------------------------</p>
            <p>Email: '.$row['email'].'</p> 
            <p>------------------------</p>

            Thank You
            ';
            if ($mail->send()){
            echo "<script type='text/javascript'>alert('You have successfully contacted the agent.');</script>";
            }
        } catch (Exception $e) {
           echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
       }
    }
}


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
                        <p>Seller Id: <?php echo $searchedHouse['sellerId'];?> </p>
                    </div>
                    <div class="col-md-6">
                        <?php 
                            if ($_SESSION['type']  == '0'){
                                echo '<h2> Please Login/Register to learn more on which Housing Grants you can apply for</h2>';
                            }
                            if ($_SESSION['type']  == '1'){
                                $output = $flatType = $flatTYPE = $flatLocation = $Citizen = $citizenship = $isAboveAge = $nearP = $parentloc = "";
                                $firstTime = $married = $age = $income = 0;
                                $email = $_SESSION['id'];
                                $userId = mysqli_real_escape_string($conn,$email);
                                $fetchUserDetails = mysqli_query($conn,"SELECT * FROM buyer WHERE email ='".$email."'");
                                $userDetails = mysqli_fetch_array($fetchUserDetails);
                                
                                  
                                //echo $searchedHouse['resalePrice'];
                                $flatType = $searchedHouse['flatType'];
                                $flatLocation = $searchedHouse['town'];
                                $firstTime = $userDetails['firstTime'];
                                $married = $userDetails['married'];
                                $age = $userDetails['age'];
                                $income = $userDetails['income'];
                                $Citizen = $userDetails['citizenship'];
                                $parentloc = $userDetails['parentLocation'];
                                
                                if($flatType == "5 ROOM"){
                                    $flatTYPE = "5 ROOM";
                                }else{
                                    $flatTYPE = "2-4 ROOM";
                                }
                        
                                if($Citizen == 'Singaporean'){
                                   $citizenship = "SC";
                                }else{
                                   $citizenship = "other";
                                }
                               if($married == 0){
                                    if($age >= 35){
                                        $isAboveAge = "yes"; 
                                    }else{
                                        $isAboveAge = "n/a";
                                    }
                                }else{
                                    $isAboveAge = "n/a";
                                }
                                if($flatLocation == $parentloc){
                                    $nearP = "yes";
                                }else{
                                    $nearP = "n/a";
                                }
//                                echo $citizenship." ";
//                                echo $married." ";
//                                echo $isAboveAge." ";
//                                echo $nearP." ";
//                                echo $income." ";
//                                echo $firstTime." ";
//                                echo $flatType." ";
//                                echo $flatTYPE." ";
                                $fetchGrantDetails = "SELECT grantType, grantAmount FROM housinggrant"
                                        ." WHERE firstTimer =".$firstTime." AND married =".$married." AND citizenship ='".$citizenship."' "
                                        ." AND aboveAge35 = '".$isAboveAge."' AND locationNearParents = '".$nearP."' "
                                        ." AND (flatType ='".$flatTYPE."' OR flatType ='n/a') "
                                        ." AND (incomeFloor <= ".$income." AND incomeCeiling >=".$income.")";
                                $result = mysqli_query($conn,$fetchGrantDetails);
                                echo '<h5>Possible Housing Grant you can be eligible for.</h3>';
                                $num = mysqli_num_rows($result);
                                if ($num > 0){
                                    while($row = mysqli_fetch_assoc($result)){
                                        echo '<div>'.$row["grantType"].'</div>';
                                        echo '<small>Amount Claimable: $'.$row["grantAmount"].'</small>';
                                    }
                                }
                                else{
                                    echo '<h5>You are not eligible for any of the Housing Grants.</h3>';
                                }
                               // echo $output;
                                //include 'menu-buyer.php'; 
                            }
                            if ($_SESSION['type']  == '2'){
                                //include 'menu-agent.php'; 
                            }

                        ?>
                    </div>
                    <div class="col-md-12" style="padding-top:10px; margin: auto; text-align:center;">
                        <?php 
                            if($_SESSION['type']=='1'){
                        ?>
                            <form method="POST" style="margin:0auto;">
                                <input type="hidden" name="buyerId" value="<?php echo $buyerId;?>">
                                <input type="hidden" name="resaleId" value="<?php echo $searchedHouse['resaleId'];?>">
                                <input type="hidden" name="resaleTown" value="<?php echo $searchedHouse['town'];?>">
                                <input type="submit" style ="border-radius: 12px; background-color:yellow; font-family:Roboto;" class="button" name="interestedhouse" value="Contact Agent">
                            </form>
                        <?php 
                            }
                            else{
                        ?>
                            <button disabled>Please Sign In to Contact Agent</button>
                        <?php
                            }
                        ?>
                    </div>
                </div>
                
            </div>               
        </div>
        <script>
            $(document).ready(function(){
            var SpouseC = "";
            $('#SpouseC').change(function(){
                SpouseC = $(this).val();
                    alert("Submitted");
                    $.ajax({
                        type:'POST',
                        url:'fetchGrantForm.php',
                        data:{SpouseC:SpouseC},
                        success:function(data){
                            $('#time').html(data);
                        }

                    });
                });
            </script>
    </body>
</html>