<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connection.php';
$email = $_SESSION['id'];
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
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <!-- Data tables -->

        
        

        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include 'menu.php'; ?>
        <!-- Outermost container containing content -->
        <div class="container col-md-10 col-10 col-lg-10" style="top:15%;">
            <!-- Title of Current Webpage -->
            <h1 class="title">Home</h1>
            <!-- Populate the table -->
            <div  class="table-bg">
                <table id="data" class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Town</th>
                            <th>Block</th>
                            <th>Street Name</th>
                            <th>Flat Type</th>
                            <th>Storey</th>
                            <th>Floor Area (sqf)</th>
                            <th>Flat Model</th>
                            <th>More Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $query = mysqli_query($conn,"SELECT resaleId,town,block,streetName,flatType,storey,floorArea,FlatModel from resale_putup LIMIT 2000");
                        
                        while($row = mysqli_fetch_assoc($query)):
                        ?>
                        <tr>
                            <td><?php echo $row['resaleId']; ?></td>
                            <td><?php echo $row['town']; ?></td>
                            <td><?php echo $row['block']; ?></td>
                            <td><?php echo $row['streetName']; ?></td>
                            <td><?php echo $row['flatType']; ?></td>
                            <td><?php echo $row['storey']; ?></td>
                            <td><?php echo $row['floorArea']; ?></td>
                            <td><?php echo $row['FlatModel']; ?></td>
                            <td></td>
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
                    "columnDefs": [ {
                    "targets": -1,
                    "data": null,
                    "defaultContent": "<button>Click Here!</button>"
                } ],
                    
                });
                table.buttons().container()
                    .insertAfter( '#data_filter' );
            });

        </script>
        
        
        
    </body>
</html>
