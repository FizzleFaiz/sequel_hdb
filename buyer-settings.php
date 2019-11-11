<?php

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
        <title>Change Password</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        
        <script src="js/passwordcontroller.js" type="text/javascript"></script>
        <script src="js/registration_validation.js" type="text/javascript"></script>
        <link href="css/main.css" rel="stylesheet" type="text/css"/>
        <?php include 'buyer_settings_validation.php'; ?>
    </head>
    <body ng-app="Settings">
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
            <h1 class="title">Settings</h1>
            <!-- Settings -->
            <div class="table-bg" ng-controller="PasswordController" style="padding:1;">
                <form id="settings-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="settings" method="POST" onsubmit="return passwordCheck();">
                    <h1 style="text-align: center;">Profile: <?php echo $_SESSION["name"]; ?></h1>
                    <div class = "form-group">
                        <label>Marital Status</label>
                        </br>
                        <select id="married" name="married">
                            <option value ="0">Single</option>
                            <option value="1">Married</option>
                        </select>

                    </div>
                    <div class = "form-group">
                        <label>Citizenship</label>
                        </br>
                        <select id="citizen" name="citizen">
                            <option value ="Singaporean">Singaporean</option>
                            <option value="PR">Permanent Resident</option>
                            <option value="Other">Other</option>
                        </select>

                    </div>
                    <div class="form-group" data-tip="Average gross monthly household income for 12 months prior">
                        <label>Income Status per month ($) </label>
                            <input type="text" name="income" id="name" tabindex="1" class="form-control" required placeholder="Income" value="<?php if (isset($_POST['income'])) echo $_POST['income']; ?>">
                            <div style="<?php echo $incomeStyle; ?>"> <?php echo $incomeErr;?></div> 
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Location of Parent's Stay</label>
                        </br>
                        <select id="parentLoc" name ="parentLoc">
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

                    </div>

                    <label>Change Password:</label>
                    <label>
                      <input onclick="document.getElementById('oldpass').disabled = false; document.getElementById('password').disabled = false; document.getElementById('confirm-password').disabled = false;" type="radio" name="type" value='annual' checked="checked"> Yes
                    </label>
                    <label>
                      <input onclick="document.getElementById('oldpass').disabled = true; document.getElementById('password').disabled = true; document.getElementById('confirm-password').disabled = true;" type="radio" name="type" value="by_date">No
                    </label>
                    <div>
                        <label>Old Password</label>
                        <input type="password" name="oldpass" id="oldpass" tabindex="2" class="form-control" placeholder="Old Password"  required>
                        <div style="<?php echo $oldpwdStyle; ?>"> <?php echo $oldpwdErr;?></div>
                    </div>
                     
                    <!-- New Password-->
                    <div>
                        <label data-tip="Password should contain at least 1 number,1 lowercase, 1 uppercase and 6 characters long ">New Password</label>
                        <input type="password" name="pwd1" ng-model="password" id="password" tabindex="2" class="form-control" placeholder="New Password" ng-change="analyze(password)" value="<?php if (isset($_POST['pwd1'])) echo $_POST['pwd1']; ?>" required>
                        <div style="<?php echo $pwdStyle; ?>"> <?php echo $pwdErr;?></div> 
                         <!-- Checkbox to show password -->
                         <input type="checkbox" onclick="showPass()"><label id="showPass">Show Password</label>
                         <!-- Bar and text to indicate the strength of a password -->
                         </br>
                         <label class="passwordIndicator" for="passwordIndicator">{{ passwordIndicatorField }}</label>
                         <div ng-style="passwordStrength"></div>
                    </div>
                    
                    <!-- Confirm Password -->
                    <div>
                        <label data-tip="Password should be the same as above">Confirm Password</label>
                        <input type="password" name="pwd2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm New Password" ng-model="password1" ng-change="analyze1(password1)" value="<?php if (isset($_POST['pwd2'])) echo $_POST['pwd2']; ?>" required>
                        <div style="<?php echo $pwdcfmStyle; ?>"> <?php echo $pwdcfmErr;?></div>
                        <!-- Checkbox to show password -->
                        <input type="checkbox" onclick="showPass1()"><label id="showPass">Show Password</label>
                        <!-- Bar and text to indicate the strength of a password -->
                        </br>
                        <label class="passwordIndicator" for="passwordIndicator">{{ passwordIndicatorField1 }}</label>
                        <div ng-style="password1Strength"></div>
                    </div>
                    <div style="text-align: center;">
                        <button type="submit" class="btn"><i class="fa fa-check"></i>Change Password</button>
                        <div style="color:red;"><?php echo $cfmMsg; ?></div>
                    </div>
                    
                    
                    
                </form>
            </div>
        </div>
        <script>
                function showPass() {
                    var show = document.getElementById("password");
                    if (show.type === "password"){
                        show.type = "text";
                    } else {
                        
                        show.type = "password";
                    }
                }
                function showPass1(){
                    var show = document.getElementById("confirm-password");
                    if (show.type === "password"){
                        show.type = "text";
                    } else {
                        show.type = "password";
                    }
                }
            </script>
        
        
    </body>
</html>
