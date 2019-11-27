<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include 'connection.php';
session_start();
if (isset($_POST['Remove'])){
    mysqli_query($conn, 'DELETE FROM resale_putup '
            . 'WHERE resaleId = "'.$_POST['removeResaleId'].'" '
            . 'AND sellerId = "'.$_SESSION['sellerId'].'"');
}
?>
<html>
    <head>
        <title>Remove House</title>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php include 'menu-agent.php';  ?>
        <!-- Outermost container containing content -->
        <div class="container col-md-10 col-10 col-lg-10" style="top:10%;">
            <h1 class="title">Remove House</h1>
            <div style="text-align:right;">
                <form method="POST">
                    <input type="text" name="searchResaleId">
                    <input type="submit" name="filterResaleId" value ="Search Resale Id">
                </form>
            </div>
            
            <?php 
                if (isset($_POST['filterResaleId'])){
                    $searchResaleId = mysqli_escape_string($conn, $_POST['searchResaleId']);
                    $sql = mysqli_query($conn, "SELECT resaleId FROM resale_putup WHERE available = 0 AND sellerId = \"".$_SESSION['sellerId']."\""); 
                    if ($searchResaleId == NULL){
                        $query = mysqli_query($conn,'SELECT * FROM resale_putup WHERE available = 0 AND sellerId = "'.$_SESSION['sellerId'].'"') or die(mysqli_error($conn));
                        $num = mysqli_num_rows($query);
                    }
                    else{
                        $count = 0;
                        while($result = mysqli_fetch_array($sql)):
                        if ($result[0] == $searchResaleId){
                            $count++;
                        }
                        endwhile;

                        if ($count++ > 0){
                            $query = mysqli_query($conn,'SELECT * FROM resale_putup WHERE available = 0 AND resaleId ='.$searchResaleId.' AND sellerId = "'.$_SESSION['sellerId'].'"') or die(mysqli_error($conn));
                            $num = mysqli_num_rows($query);
                        }
                        else{
                            $num = 0;
                        }
                    }
                }
                else{
                    $query = mysqli_query($conn,'SELECT * '
                            . 'FROM resale_putup '
                            . 'WHERE available = 0 '
                            . 'AND sellerId = "'.$_SESSION['sellerId'].'"') 
                            or die(mysqli_error($conn));
                    $num = mysqli_num_rows($query);
                }
                if ($num > 0){
                    echo '<table style="font-family: arial, sans-serif; border-collapse: collapse; width: 100%;">
                        <tr style="background-color: #dddddd;">
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Resale Id</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Town</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Block</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Street Name</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Flat Type</th>
                            <th style="border: 1px solid #dddddd; text-align: left; padding: 8px;">Price</th>
                            <th></th>
                        </tr>';
                
                
                        while($row = mysqli_fetch_assoc($query)):
                            echo "<tr style=\"background-color: #ffffff;\">";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['resaleId']."</td>";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['town']."</td>";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['block']."</td>";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['streetName']."</td>";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['flatType']."</td>";
                                echo "<td style=\"border: 1px solid #dddddd; text-align: left; padding: 8px;\">".$row['resalePrice']."</td>";
                                echo "<td>";
                                    echo "<form method=\"POST\" style=\"margin:auto; text-align:center;\">";
                                        echo "<input type=\"hidden\" name=\"removeResaleId\" value=\"".$row['resaleId']."\">";
                                        echo "<input type=\"submit\" style=\"display:inline-block; height:100%;\" class=\"button\" name=\"Remove\" value=\"Remove\">";
                                    echo "</form>";
                                echo "</td>";
                            echo "</tr>";
                        endwhile;
                    echo '</table>';
                }
                else{
                    echo "<div style=\"background-color: #ffffff; text-align:center;\">";
                    echo "<p>No Results Found</p>";
                    echo "</div>";
                }
            ?>
        </div>
    </body>
</html>