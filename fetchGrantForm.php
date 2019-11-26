 <?php 
    $output ="";
    $firstTime = $income = $MaritalS = 0;
    $Citizen = $NearP = $WithP = $age =  "";
    if($_SERVER["REQUEST_METHOD"] == "POST"){
       if($_POST['firstTimer'] == "yes"){
            echo $firstTime = 1;
        }else{
            $firstTime = 0;
        }
        if($_POST['BuyerC'] == "SC"){
            if($_POST['MaritalS'] == "single"){
                $Citizen = "SC";
                $MaritalS = 0;
               if($_POST['age'] == "yes"){
                    $age = "yes";
               }else{
                   $age = "n/a";
               }
            }else{
                $MaritalS = 1;
                $Citizen = "SC";
                $age = "n/a";
                if($_POST['SpouseC'] == "SPR"){
                    $Citizen = "SC/SPR";
               }
            }
        }else{
            $Citizen = "SPR";
        }
        if($_POST['NearParents']=="yes"){
            $NearP = "yes";
            if($_POST['WithParent']=="yes"){
                $WithP = "yes";
            }else{
                $WithP = "no";
            }
        }else{
            $NearP = "n/a";
            $WithP = "n/a";
        }
    $output = "";
    $sql= "SELECT DISTINCT grantType FROM housinggrant"
            ." WHERE firstTimer =".$firstTime
            ." AND citizenship =".$Citizen
            ." AND locationNearParents =".$NearP
            ." AND livingWithParents =".$WithP
            ." AND aboveAge35 =".$age
            ." AND married =".$MaritalS;

    if($result = mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_assoc($result)){
            $output .=  '<div class="card col-sm-2">'
            .' <div class ="card-body">'
            .' <h6 class="card-subtitle mb-2 text-muted">'.$row['grantType'].'</h6>'
            .' </div>'
            .' </div>';
        }

        }
    echo $output;

    }       
 ?>