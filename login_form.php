<?php
session_start();

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
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="css/loginCSS.css" rel="stylesheet" type="text/css"/>
        <?php include 'login_validation.php' ?>
    </head>
    <body>
        <div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading" style="text-align:center;">
						<div class="row">
                                                    <a href="#" class="active" id="login-form-link">Login</a>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" role="form">
                                                                    <!-- Email Input -->
                                                                    <div class="form-group">
                                                                            <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address/Seller Id" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>">
                                                                            <div style="<?php echo $emailStyle; ?>"> <?php echo $emailErr;?></div> 
                                                                    </div>
                                                                <!-- Password Input -->
                                                                    <div class="form-group">
                                                                            <input type="password" name="pwd" id="password" tabindex="2" class="form-control" placeholder="Password">
                                                                            <div style="<?php echo $pwdStyle; ?>"> <?php echo $pwdErr;?></div> 
                                                                            <!-- Checkbox to show password -->
                                                                            <input type="checkbox" onclick="showPass()"><label id="showPass">Show Password</label>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <input type ="radio" name="group" value="buyer" checked>Buyer
                                                                        <input type="radio" name="group" value="agent">Agent
                                                                    </div>


                                                                    <div class="form-group">
                                                                            <div class="row">
                                                                                    <div class="col-sm-6 col-sm-offset-3">
                                                                                            <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                                                                            <div style="<?php echo $loginStyle; ?>"> <?php echo $loginErr;?></div>
                                                                                    </div>

                                                                                    <div class="message" style="text-align:center;">
                                                                                        <div class="col-sm-6 col-sm-offset-3">
                                                                                            <a href="register_form.php">New User? Register here</a>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>

                                                                    </div>
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
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
       
        
    </script>
        
    </body>
</html>
