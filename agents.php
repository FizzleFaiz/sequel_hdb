<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connection.php';

            $jsonArray1 = array();

            $query1 = mysqli_query($conn,"SELECT a.companyName, SUM(a.sales) as totalSales"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.companyName"
                    . " ORDER BY totalSales DESC LIMIT 15");

            while($row1 = mysqli_fetch_assoc($query1)):
                $jsonArrayItem1 = array();
                $jsonArrayItem1['label'] = $row1['companyName'];
                $jsonArrayItem1['y'] = $row1['totalSales'];
                array_push($jsonArray1, $jsonArrayItem1);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
            
            $jsonArray2 = array();

            $query2 = mysqli_query($conn,"SELECT s1.name, a1.companyName, a1.rating, a1.sales"
                    . " FROM seller s1, agent a1"
                    . " WHERE s1.sellerId = a1.sellerId AND a1.companyName IN (SELECT c.companyName FROM (SELECT a.companyName, SUM(a.sales) as totalSales, COUNT(a.sellerId) as totalAgents"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY s.name"
                    . " ORDER BY totalSales DESC LIMIT 15) c)"
                    . " ORDER BY a1.rating DESC, a1.sales DESC LIMIT 15");

            while($row2 = mysqli_fetch_assoc($query2)):
                $jsonArrayItem2 = array();
                $jsonArrayItem2['label'] = $row2['name'];
                $jsonArrayItem2['y'] = $row2['sales'];
                array_push($jsonArray2, $jsonArrayItem2);
            endwhile;
            
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Agents</title>
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
        <div class="container col-md-10 col-10 col-lg-10" style="top:15%;">
            <!-- Title of Current Webpage -->
            <h1 class="title">Agent</h1>
    <?php
      
        if(isset($_POST['button1'])) { 
            $jsonArray1 = array();

            $query1 = mysqli_query($conn,"SELECT a.companyName, SUM(a.sales) as totalSales"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.companyName"
                    . " ORDER BY totalSales DESC LIMIT 15");

            while($row1 = mysqli_fetch_assoc($query1)):
                $jsonArrayItem1 = array();
                $jsonArrayItem1['label'] = $row1['companyName'];
                $jsonArrayItem1['y'] = $row1['totalSales'];
                array_push($jsonArray1, $jsonArrayItem1);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
            
            $jsonArray2 = array();

            $query2 = mysqli_query($conn,"SELECT s.name, a.sales, a.rating"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " ORDER BY a.rating DESC, a.sales DESC LIMIT 20");

            while($row2 = mysqli_fetch_assoc($query2)):
                $jsonArrayItem2 = array();
                $jsonArrayItem2['label'] = $row2['name'];
                $jsonArrayItem2['y'] = $row2['sales'];
                array_push($jsonArray2, $jsonArrayItem2);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
        } 
        if(isset($_POST['button2'])) { 
            $jsonArray1 = array();

            $query1 = mysqli_query($conn,"SELECT a1.companyName, SUM(a1.sales) / COUNT(a1.sellerId) AS avgSales"
                    . " FROM seller s1, agent a1"
                    . " WHERE s1.sellerId = a1.sellerId AND a1.companyName IN "
                    . " (SELECT c.companyName FROM (SELECT a.companyName, SUM(a.sales) as totalSales, COUNT(a.sellerId) as totalAgents"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.companyName"
                    . " ORDER BY totalSales DESC LIMIT 15) c)"
                    . " GROUP BY a1.companyName"
                    . " ORDER BY avgSales DESC");

            while($row1 = mysqli_fetch_assoc($query1)):
                $jsonArrayItem1 = array();
                $jsonArrayItem1['label'] = $row1['companyName'];
                $jsonArrayItem1['y'] = $row1['avgSales'];
                array_push($jsonArray1, $jsonArrayItem1);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
            
            $jsonArray2 = array();

            $query2 = mysqli_query($conn,"SELECT s1.name, a1.companyName, a1.rating, a1.sales"
                    . " FROM seller s1, agent a1"
                    . " WHERE s1.sellerId = a1.sellerId AND a1.companyName IN (SELECT c.companyName FROM (SELECT a.companyName, SUM(a.sales) as totalSales, COUNT(a.sellerId) as totalAgents"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY s.name"
                    . " ORDER BY totalSales DESC LIMIT 15) c)"
                    . " ORDER BY a1.rating DESC, a1.sales DESC LIMIT 15");

            while($row2 = mysqli_fetch_assoc($query2)):
                $jsonArrayItem2 = array();
                $jsonArrayItem2['label'] = $row2['name'];
                $jsonArrayItem2['y'] = $row2['sales'];
                array_push($jsonArray2, $jsonArrayItem2);
            endwhile;
        }
        if(isset($_POST['button3'])) { 
            $jsonArray1 = array();

            $query1 = mysqli_query($conn,"SELECT a.companyName, SUM(a.sales) as totalSales"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.companyName"
                    . " ORDER BY totalSales DESC LIMIT 15");

            while($row1 = mysqli_fetch_assoc($query1)):
                $jsonArrayItem1 = array();
                $jsonArrayItem1['label'] = $row1['companyName'];
                $jsonArrayItem1['y'] = $row1['totalSales'];
                array_push($jsonArray1, $jsonArrayItem1);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
            
            $jsonArray2 = array();

            $query2 = mysqli_query($conn,"SELECT s1.name, a1.companyName, a1.rating, a1.sales"
                    . " FROM seller s1, agent a1"
                    . " WHERE s1.sellerId = a1.sellerId AND a1.companyName IN (SELECT c.companyName FROM (SELECT a.companyName, SUM(a.sales) as totalSales, COUNT(a.sellerId) as totalAgents"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY s.name"
                    . " ORDER BY totalSales DESC LIMIT 15) c)"
                    . " ORDER BY a1.rating DESC, a1.sales DESC LIMIT 15");

            while($row2 = mysqli_fetch_assoc($query2)):
                $jsonArrayItem2 = array();
                $jsonArrayItem2['label'] = $row2['name'];
                $jsonArrayItem2['y'] = $row2['sales'];
                array_push($jsonArray2, $jsonArrayItem2);
            endwhile;
        }
        
         if(isset($_POST['button4'])) { 
            $jsonArray1 = array();

            $query1 = mysqli_query($conn,"SELECT a.companyName, SUM(a.sales) as totalSales"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.companyName"
                    . " ORDER BY totalSales DESC LIMIT 15");

            while($row1 = mysqli_fetch_assoc($query1)):
                $jsonArrayItem1 = array();
                $jsonArrayItem1['label'] = $row1['companyName'];
                $jsonArrayItem1['y'] = $row1['totalSales'];
                array_push($jsonArray1, $jsonArrayItem1);
//                        foreach($result as $row){
//                            array_push($dataPoints, array("x"=> $row->x, "y"=> $row->y));
//                            }
            endwhile;
            
            $jsonArray2 = array();

            $query2 = mysqli_query($conn,"SELECT a.sales, a.experience, SUM(a.sales)/COUNT(a.experience) AS avgByYear"
                    . " FROM seller s, agent a"
                    . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                    . " GROUP BY a.experience");

            while($row2 = mysqli_fetch_assoc($query2)):
                $jsonArrayItem2 = array();
                $jsonArrayItem2['label'] = $row2['experience'];
                $jsonArrayItem2['y'] = $row2['avgByYear'];
                array_push($jsonArray2, $jsonArrayItem2);
            endwhile;
        }
        
    ?> 
      
    <form method="post"> 
        <input type="submit" name="button1"
                value="Total Sales"/> 
          
        <input type="submit" name="button2"
                value="Average Agent Sales"/> 
    </form>
<div>
        <div id="chartContainer1" style="height: 400px; width: 100%;"></div>
            <form method="post"> 
        <input type="submit" name="button3"
                value="Top Agents"/> 
          
        <input type="submit" name="button4"
                value="Average Sales By Experience"/> 
    </form>
        <div id="chartContainer2" style="height: 400px; width: 100%;"></div>
        <script>
        window.onload = function() {

        var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                theme: "light2",
                title:{
                        text: "Companies"
                },
                axisY: {
                        title: "Sales"
                },
                axisX:{
                        interval: 1,
                        labelFontSize: 8
                        
                },
                data: [{
                        type: "column",
                        yValueFormatString: "#,##0.## Sales",
                        dataPoints: <?php echo json_encode($jsonArray1, JSON_NUMERIC_CHECK); ?>
                }]
        });


                var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2",
                title:{
                        text: "Agents"
                },
                axisY: {
                        title: "Sales"
                },
                axisX:{
                        interval: 1,
                        labelFontSize: 8
                },
                data: [{
                        type: "spline",
                        yValueFormatString: "#,##0.## Sales",
                        dataPoints: <?php echo json_encode($jsonArray2, JSON_NUMERIC_CHECK); ?>
                }]
        });
        
        chart1.render();
        chart2.render();
        }
        </script>
</div>
            </br>

            <!-- Outermost container containing content -->
        <div class="container" style="top:15%;">
            <!-- Title of Current Webpage -->
            <h1 class="title">List of Agents</h1>
            <!-- Populate the table -->
                        <div  class="table-bg">
                <table id="data" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Company</th>
                            <th>Experience</th>
                            <th>Rating</th>
                            <th>Sales</th>
                            <th>Contact No.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = mysqli_query($conn,"SELECT s1.sellerId, s1.name, a1.companyName, a1.experience, a1.rating, a1.sales, s1.contactNo"
                                . " FROM seller s1, agent a1"
                                . " WHERE s1.sellerId = a1.sellerId AND a1.companyName IN (SELECT c.companyName FROM (SELECT a.companyName, SUM(a.sales) as totalSales, COUNT(a.sellerId) as totalAgents"
                                . " FROM seller s, agent a"
                                . " WHERE s.isAgent = 1 AND s.sellerId = a.sellerId"
                                . " GROUP BY s.name"
                                . " ORDER BY totalSales DESC LIMIT 15) c)"
                                . " ORDER BY a1.rating DESC, a1.sales DESC LIMIT 10000");
                        
                        while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?php echo $row['sellerId']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['companyName']; ?></td>
                            <td><?php echo $row['experience']; ?></td>
                            <td><?php echo $row['rating']; ?></td>
                            <td><?php echo $row['sales']; ?></td>
                            <td><?php echo $row['contactNo']; ?></td>
                        </tr>
                       
                        <?php endwhile; ?>
                    </tbody>
                    
                </table>
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