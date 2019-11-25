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

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if (isset($_POST['houseDetails']) && !empty($_POST['houseDetails'])){
        $_SESSION['houseDetails'] = $_POST['houseDetails'];
        header('Location: housing_details.php');
    }
}


?>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width">
        <title>Main Page</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <?php // include 'housing_details.php' ?>
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
        <div class="container col-lg-12" style="top:15%;">
            <!-- Title of Current Webpage -->
            <h1 class="title">Home</h1>
            <!-- Populate the table -->
            <div class="card" style="background-color:transparent;">
                <form method="POST" style="background-color:yellow;">
                    <div class="row">
                        <select id="flattype" name="flattype">
                            <?php $query = mysqli_query($conn,"SELECT DISTINCT flatType FROM resale_putup ORDER BY flatType");
                            while($row = mysqli_fetch_assoc($query)):
                                echo "<option value'".$row['flatType']."'>".$row['flatType']."</option>";
                            endwhile;
                            ?>
                        </select>
                        <select id="town" name="town">
                            <?php $query = mysqli_query($conn,"SELECT DISTINCT town FROM resale_putup ORDER BY town");
                            while($row = mysqli_fetch_assoc($query)):
                                echo "<option value='".$row['town']."'>".$row['town']."</option>";
                            endwhile;
                            ?>
                        </select>
                        <select id="price" name="price">
                            <option value="any">Any Price</option>
                            <option value ="200000">MAX $200,000</option>
                            <option value ="400000">MAX $400,000</option>
                            <option value ="600000">MAX $600,000</option>
                            <option value ="800000">MAX $800,000</option>
                            <option value ="1000000">MAX $1,000,000</option>
                        </select>
                        <input type="submit" name="filteredSearch" id="filteredSearch" value="Search"/>
                    </div>
                </form>
                <div class ="row" style="">
                    <?php
                    if (isset($_POST['filteredSearch'])){
                        $flattype = $_POST['flattype'];
                        $town = $_POST['town'];
                        $price = intval($_POST['price']);
                        if ($price == 'any'){
                            $query = mysqli_query($conn,"SELECT * from resale_putup where available > 0 AND flatType ='".$flattype."' AND town = '".$town."' LIMIT 2000")or die(mysqli_error($conn));
                            
                        }
                        else
                        {
                            $query = mysqli_query($conn,"SELECT * from resale_putup where available > 0 AND flatType ='".$flattype."' AND town = '".$town."' AND resalePrice <= ".$price." LIMIT 2000")or die(mysqli_error($conn));
                        }
                    }
                    else{
                        $query = mysqli_query($conn,"SELECT * from resale_putup where available > 0 LIMIT 2000");
                    }
                    if ($length = mysqli_num_rows($query) == 0){
                        echo "Nothing was Found, Please try another search";
                    }
                    else
                        {
                    
                            while($row = mysqli_fetch_assoc($query)):
                    ?>
                        <div class="col-md-3">
                            <div class ="card" style="margin:10px;">
                            <img src="img/BTO_IMAGE.jpg" style="height:200px; width:100%;">
                            <?php echo "<h4 align=\"center\">".$row['resaleId']. " " .$row['town']."</h4>"; ?>
                            <div class="row" >
                                <div class="col-sm-7">
                                    <?php echo "<p style=\"margin-left:10px;4\">".$row['block']. " " .$row['streetName']."<br>Type: ".$row['flatType']; ?>
                                </div>
                                <div class="col-sm-5">
                                    <?php echo "<p align=\"center;\">$".$row['resalePrice']."<p>";?>
                                    <form method="POST">
                                        <input type="hidden" name="houseDetails" id ="houseDetails" value="<?php echo $row['resaleId'];?>"/>
                                        <input type="submit" class="button" name="selectedHouse" id="selectedHouse" value="Details"/>
                                    </form>

                                </div>
                            </div>
                        </div>
                        </div>
                    <?php endwhile;
                        }
                        ?>


                </div>
            </div>
            
            
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
