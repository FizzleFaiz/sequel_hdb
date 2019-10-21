<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sequel HDB</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="js/moment.min.js" type="text/javascript"></script>
        <!-- CSS -->
        <link href="css/loginCSS.css" rel="stylesheet" type="text/css"/>
        <!-- Validation -->
        <script src="js/passwordcontroller.js" type="text/javascript"></script>
        <script src="js/registration_validation.js" type="text/javascript"></script>
        <?php include 'register_validation.php' ?>
    </head>
    <body ng-app="Register">
        <div class="container" >
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12" ng-controller="PasswordController">
                                                            <form id="register-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" name="register" method="POST" onsubmit="return validate();"  >
									<div class="form-group">
                                                                            <label>Full Name</label>
										<input type="text" name="name" id="name" tabindex="1" class="form-control" required placeholder="Full Name" value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>">
                                                                                <div style="<?php echo $nameStyle; ?>"> <?php echo $nameErr;?></div> 
									</div>
                                                                        <div class="form-group">
                                                                            <label>Date Of Birth</label>
                                                                                <input type="date" name ="dob" id="dob" tabindex="1" class="form-control" required value="<?php if (isset($_POST['dob'])) echo $_POST['dob']; ?>">
                                                                                <div style="<?php echo $dobStyle; ?>"> <?php echo $dobErr;?></div>
                                                                        </div>
									<div class="form-group">
                                                                            <label>Email</label>
										<input type="email" name="email" id="email" tabindex="1" class="form-control" required placeholder="Email Address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                                                                                <div style="<?php echo $emailStyle; ?>"> <?php echo $emailErr;?></div>
									</div>
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
                                                                            <label>First Time Buyer Status</label>
                                                                            </br>
                                                                            <input type ="radio" name="firsttime" value="0" checked>Yes<br>
                                                                            <input type="radio" name="firsttime" value="1">No
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
									<div class="form-group">
                                                                            <label>Password</label>
										<input type="password" name="pwd1" ng-model="password" id="password" tabindex="2" class="form-control" placeholder="Password" ng-change="analyze(password)" value="<?php if (isset($_POST['pwd1'])) echo $_POST['pwd1']; ?>" required>
                                                                                <div style="<?php echo $pwdStyle; ?>"> <?php echo $pwdErr;?></div> 
                                                                             <!-- Checkbox to show password -->
                                                                             <input type="checkbox" onclick="showPass()"><label id="showPass">Show Password</label>
                                                                             <!-- Bar and text to indicate the strength of a password -->
                                                                             </br>
                                                                             <label class="passwordIndicator" for="passwordIndicator">{{ passwordIndicatorField }}</label>
                                                                             <div ng-style="passwordStrength"></div>
									</div>
                                                                    
									<div class="form-group" data-tip="Password should be the same as above">
                                                                            <label>Confirm Password</label>
										<input type="password" name="pwd2" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password" ng-model="password1" ng-change="analyze1(password1)" value="<?php if (isset($_POST['pwd2'])) echo $_POST['pwd2']; ?>" required>
                                                                                <div style="<?php echo $pwdcfmStyle; ?>"> <?php echo $pwdcfmErr;?></div>
                                                                                <!-- Checkbox to show password -->
                                                                                <input type="checkbox" onclick="showPass1()"><label id="showPass">Show Password</label>
                                                                                <!-- Bar and text to indicate the strength of a password -->
                                                                                </br>
                                                                                <label class="passwordIndicator" for="passwordIndicator">{{ passwordIndicatorField1 }}</label>
                                                                                <div ng-style="password1Strength"></div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register">
											</div>
										</div>
									</div>
                                                                            <p class="message">Already Registered? <a href="login_form.php">Login </a></p>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
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
