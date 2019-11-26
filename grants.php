<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
include 'connection.php';
//if( isset($_SESSION["id"]) &&  isset($_SESSION["pwd"]) ){
//    // Buyer
//    if($_SESSION['type']=='1'){
//        $sql = mysqli_query($conn,"SELECT name FROM buyer WHERE email='".$email."' AND password='".$password."' AND verified='1'") or die(mysqli_error($conn));
//    }
//    // Seller
//    if($_SESSION['type']=='2'){
//        $sql = mysqli_query($conn,"SELECT name FROM seller WHERE sellerId='".$email."' AND password='".$password."' AND isAgent='1'") or die(mysqli_error($conn));
//    }
//    $row = mysqli_fetch_array($sql);
//    $name = $row[0];
//    $_SESSION['name'] = $name;
//}
//else{
//    $_SESSION['type'] = '0';
//}
//$firstTimerErr = $MaritalSErr = $IncomeErr = $AgeErr = "";
//$BuyerCErr = $SpouseCErr = $NearPErr = $WithPErr = "";
//$errCheck = 0;
//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if (empty($_POST["firstTimer"])) {
//      $firstTimerErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $firstTimerErr = "";
//      }
//      if (empty($_POST["MaritalS"])) {
//      $MartialStatusErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $MaritalStatusErr = "";
//      }
//      if (empty($_POST["income"])) {
//      $IncomeErr = "Input is required";
//      $errCheck+=1;
//    } else {
//        $IncomeErr = "";
//      }
//      if (empty($_POST["age"])) {
//      $AgeErr = "Input is required";
//      $errCheck+=1;
//    } else {
//        $AgeErr = "";
//      }
//      if (empty($_POST["BuyerCitizenship"])) {
//      $BuyerCErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $BuyerCErr = "";
//      }
//      if (empty($_POST["SpouseCitizenship"])) {
//      $SpouseCErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $SpouseCErr = "";
//      }
//      if (empty($_POST["LiveNearParents"])) {
//      $NearPErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $NearPErr = "";
//      }
//       if (empty($_POST["WithParent"])) {
//      $WithPErr = "Selection is required";
//      $errCheck+=1;
//    } else {
//        $WithPErr = "";
//      }
//}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Housing Grants</title>
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
            <h1 class="title">Housing Grants</h1>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="container-fluid">
           <div class="row">
                <div class="card col-sm-4">
                    <div class ="card-body">
                        <h1 class="card-title">Check Eligibile for Housing Grants</h1>
                        <h6 class="card-subtitle mb-2 text-muted">We can help find out what grants are available to you
                        Just enter your details in the form.
                        </h6>
                        <div class="form-group">
                              <label for="time">eligilbe shit</label>
                              <select class="form-control" id="time">
                                <option value="">Select an Option</option>
                              </select>
                            </div>
                    </div>
                </div>
               <br>
               <div class="col-sm-1"></div>
                <div class="card col-sm-6">
                    <div class ="card-body">
                        <form action="grants.php" method="POST" id="EligibileForm">
                            <div class="form-group">
                              <label for="firstTimer">First-time Applicant?</label>
                              <select class="form-control" id="firstTimer">
                                <option value="">Select an Option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                              </select>
                            
                            </div>
                            <!--Select age and create another form group for age if single -->
                            <div class="form-group">
                              <label for="MaritalS">Marital Status</label>
                              <select class="form-control" id="MaritalS">
                                <option value="">Select Status</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                              </select>
                           
                            </div>
<!--                            <div class="form-group">
                              <label for="income">Monthly Income</label>
                              <input type="income" class="form-control" id="income" placeholder="700">
                        
                            </div>-->
                            <!--ONLY APPEAR IF SINGLE, age if single -->
                            <div class="form-group">
                              <label for="age">Is your age above 35?</label>
                              <select class="form-control" id="age">
                                <option value="">Select an Option</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                              </select>
                       
                            </div>
                            <div class="form-group">
                              <label for="BuyerC">Buyer's Citizenship</label>
                              <select class="form-control" id="BuyerC">
                                <option value="">Select an Option</option>
                                <option value="SC">Singapore Citizen(SC)</option>
                                <option value="SPR">Singapore Permanent Resident(SPR)</option>
                              </select>
                         
                            </div>
                             <!--ONLY APPEAR IF MARRIED, spouse -->
                            <div class="form-group">
                              <label for="SpouseC">Spouse's Citizenship</label>
                              <select class="form-control" id="SpouseC">
                                <option value="">Select an Option</option>
                                <option value="SC">Singapore Citizen(SC)</option>
                                <option value="SPR">Singapore Permenant Resident(SPR)</option>
                              </select>
                         
                            </div>
                             <div class="form-group">
                              <label for="NearParents">Living Near Parents?(Within 4KM)</label>
                              <select class="form-control" id="NearParents">
                                  <option>Select Either</option>
                                  <option value="no">No</option>
                                  <option value="yes">Yes</option>
                              </select>
                           
                            </div>
                             <!--ONLY APPEAR IF Yes to living near Parents, spouse -->
                             <div class="form-group">
                              <label for="WithParent">Living with Parents?</label>
                              <select class="form-control" id="WithParent">
                                <option>Select Either</option>
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                              </select>
                     
                            </div>
                             <div class="col-md-12">
                                <button id="submitBtn" type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>                     
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container col-md-12 col-12 col-lg-12" style="top:15%;">
            <div class="card">
                <div class ="card-body">
                    <h1 class="card-title">Enhanced CPF Housing Grants</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Amounts: $5,000 to $80,000 </h6>
                    <p class="card-text">Assistance For: 
                    Lower to upper - middle income applicants of the Singles Grant
                    At least 1 of the applicants must have worked continuously for the 12 months prior to the flat application, and still be working at the point of the flat application
                    </p>
                </div>
            </div>
            <br>
            <div class="card">
                <div class ="card-body">
                    <h1 class="card-title">Enhanced CPF Housing Grants (Singles)</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Amounts: $2,500 to $40,000 </h6>
                    <p class="card-text">Assistance For: 
                        Lower to upper - middle income applicants of the Singles Grant
                        Applicant must have worked continuously for the 12 months prior to the flat application, and still be working at the point of the flat application

                    </p>
                </div>
            </div>
            <br>
            <div class="card">
                <div class ="card-body">
                    <h1 class="card-title">Singles Grant</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Amounts: Up to $25,000 </h6>
                    <p class="card-text">Assistance For: 
                    Lowerto point of the flat application
                    </p>
                </div>
            </div>
            <br>
             <div class="card">
                <div class ="card-body">
                    <h1 class="card-title">Family Grant</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Amounts: Up to $25,000 </h6>
                    <p class="card-text">Assistance For: Married/ engaged couples or families who are first-timer applicants buying an HDB resale flat
                    </p>
                </div>
            </div>
            <br>
            <div class="card">
                <div class ="card-body">
                    <h1 class="card-title">Proximity Housing Grant</h1>
                    <h6 class="card-subtitle mb-2 text-muted">Amounts: Up to $25,000 </h6>
                    <p class="card-text">Assistance For: Married/ engaged couples or families who are first-timer applicants buying an HDB resale flat
                    </p>
                </div>
            </div>
            <br>
        </div>
<!--          <script>
        $("#MaritalStatus").change(function() {
            if ($(this).val() == "single") {
              $('#age').show();
              $('#SpouseCitizenship').hide()
            } else if($(this).val() == "married"){
              $('#age').hide();
              $('#SpouseCitizenship').show();
            }else{
                $('#age').hide();
                $('#SpouseCitizenship').hide();
          });
          $("#MaritalStatus").trigger("change");
          
          $("#NearParents").change(function() {
            if ($(this).val() == "yes") {
              $('#WithParent').show();
            }else{
                $('#WithParent').hide();
            }
          });
          $("#NearParents").trigger("change");
        </script>-->
        <script>
            $(document).ready(function(){
                var firstTimer = "";
                var age = "";
                var MaritalS = "";
                var SpouseC = "";
                var NearParents = "";
                var WithParent = "";
                var BuyerC = "";
               $('#firstTimer').change(function(){
                   firstTimer = $(this).val();
                   alert(firstTimer);
                });
                $('#age').change(function(){
                   age = $(this).val();
                   alert(age);
                });
                $('#MaritalS').change(function(){
                   MaritalS = $(this).val();
                   alert(MaritalS);
                });
                $('#SpouseC').change(function(){
                   SpouseC = $(this).val();
                   alert(SpouseC);
                });
                $('#NearParents').change(function(){
                   NearParents = $(this).val();
                   alert(NearParents);
                });
                $('#WithParent').change(function(){
                   WithPArent = $(this).val();
                   alert(WithParent);
                });
                $('#BuyerC').change(function(){
                    BuyerC =  $(this).val();
                    alert(BuyerC);
                });
                $('#submitBtn').click(function(){
                    alert("Submitted");
                    $.ajax({
                        type:'POST',
                        url:'fetchGrantForm.php',
                        data:{firstTimer:firstTimer, BuyerC:BuyerC, MaritalS:MaritalS, age:age, SpouseC:SpouseC, NearParents:NearParents, WithParent:WithParent},
                        success:function(data){
                            $('#time').html(data);
                        }

                    });
                });
                    //else 2 statement if needed
             });
        </script>
    </body>
</html>