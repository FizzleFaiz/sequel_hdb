<?php
include 'connection.php';
$dataPoints1 = array();
$dataPoints = array();


//$link = new \PDO('mysql:host=rm-gs5c889f8g6s7c80vso.mysql.singapore.rds.aliyuncs.com;dbname=1801148mfr;charset=utf8mb4',
//        '1801148MFR',
//        '19ICT2103',
//        array(
//            \PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//            \PDO::ATTR_PERSISTENT => false
//        )
//        );
//$handle = $link->prepare('select town, COUNT(town) as popularity from resale_putup GROUP BY town');
//$handle->execute();
//    $result = $handle->fetchAll(\PDO::FETCH_OBJ);
//
//foreach($result as $row){
//    array_push($dataPoints, array("x"=> $row->town, "y"=> $row->popularity));
//}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Statistics</title>
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
        <?php
        

        $query = mysqli_query($conn,"SELECT town, COUNT(town) as popularity"
                . " FROM resale_putup"
                . " GROUP BY town");

        while($row = mysqli_fetch_assoc($query)):
            $jsonArrayItem = array();
            $jsonArrayItem['label'] = $row['town'];
            $jsonArrayItem['y'] = $row['popularity'];
            array_push($dataPoints, $jsonArrayItem);
        //                        foreach($result as $row){
        //                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
        //                            }
        endwhile;
        
        ?>
        <script>
            window.onload = function () {

            var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                            text: "Number of Resale Flats by Town"
                    },
                    axisX:{
                        title: "Town",
                        interval: 1
                     },
                     axisY:{
                         title:"Number of Resale Flats"
                     },
                    data: [{
                            type: "column", //change type to bar, line, area, pie, etc  
                            dataPoints: <?php  echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                    }]
            });
            chart.render();

        }
        </script>
<!--        <script>
            window.onload = function () {

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                    animationEnabled: true,
                    exportEnabled: true,
                    theme: "light1", // "light1", "light2", "dark1", "dark2"
                    title:{
                            text: "Number of Flats by Type"
                    },
                    data: [{
                            type: "column", //change type to bar, line, area, pie, etc  
                            dataPoints: <?php  echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                    }]
            });
            chart1.render();

        }
        </script>-->
        
        <!-- Outermost container containing content -->
        <div class="container col-md-10 col-10 col-lg-10" style="top:15%;">
            <h1 class="title">Number of Resale Flats </h1>
            <form>
                <select name ="location" onchange="this.form.submit()" onsubmit='return false'>
                    <option value="">Select Location</option>
                    <option value="Ang Mo Kio">Ang Mo Kio</option>
                    <option value="Bedok">Bedok</option>
                    <option value="Bishan">Bishan</option>
                    <option value="Bukit Batok">Bukit Batok</option>
                    <option value="Bukit Merah">Bukit Merah</option>
                    <option value="Bukit Panjang">Bukit Panjang</option>
                    <option value="Bukit Timah">Bukit Timah</option>
                    <option value="Central Area">Central Area</option>
                    <option value="Choa Chu Kang">Choa Chu Kang</option>
                    <option value="Clementi">Clementi</option>
                    <option value="Geylang">Geylang</option>
                    <option value="Hougang">Hougang</option>
                    <option value="Jurong East">Jurong East</option>
                    <option value="Jurong West">Jurong West</option>
                    <option value="Kallang/Whampoa">Kallang/Whampoa</option>
                    <option value="Marine Parade">Marine Parade</option>
                    <option value="Pasir Ris">Pasir Ris</option>
                    <option value="Punggol">Punggol</option>
                    <option value="Queenstown">Queenstown</option>
                    <option value="Sembawang">Sembawang</option>
                    <option value="Sengkang">Sengkang</option>
                    <option value="Serangoon">Serangoon</option>
                    <option value="Tampines">Tampines</option>
                    <option value="Toa Payoh">Toa Payoh</option>
                    <option value="Woodlands">Woodlands</option>
                    <option value="Yishun">Yishun</option>
                </select>
            </form>   
            <div id="chartContainer" style="height:300px;width: 100%;"></div>
            </br>
            <div  class="table-bg">
                <table id="data" class="table">
                    <h2 style="text-align: center;"><?php if(isset($_GET['location']) && !empty($_GET['location'])){ echo $_GET['location']; } else {echo 'Select A Location First';}?></h2>
                    <thead>
                        <tr>
                            <th>Flat Type</th>
                            <th>Number of Houses Available</th>
                            <th>Average Price</th>
                            <th>Cheapest</th>
                            <th>Expensive</th>
                            <th>Average Floor Area (m²)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if(isset($_GET['location']) && !empty($_GET['location'])){
                            
                        
                        $query = mysqli_query($conn,'SELECT flatType,COUNT(flatType) as count, AVG(resalePrice) as Average_Price, MIN(resalePrice) as Cheapest, max(resalePrice) as Expensive,AVG(floorArea) as Avg_size from resale_putup WHERE town = "'.$_GET['location'].'" GROUP BY flatType');
                        
                        while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?php echo $row['flatType']; ?></td>
                            <td><?php echo $row['count']; ?></td>
                            <td><?php echo '$'. $row['Average_Price']; ?></td>
                            <td><?php echo '$'.$row['Cheapest']; ?></td>
                            <td><?php echo '$'.$row['Expensive']; ?></td>
                            <td><?php echo $row['Avg_size']; ?></td>
                        </tr>
                       
                        <?php endwhile; }?>
                    </tbody>
                    
                </table>
            </div>
            <div id="chartContainer1" style="width: 100%;"></div>

            

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
            $(document).ready(function() {
                var table = $("#data").DataTable({
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],
                    
                });
                table.buttons().container()
                    .insertAfter( '#data_filter' );
            });

        </script>
        
        
        
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </body>
</html>