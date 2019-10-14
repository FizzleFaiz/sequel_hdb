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
        <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
        <link href="css/loginCSS.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container">
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
							<div class="col-lg-12">
								<form id="register-form" action="https://phpoll.com/register/process" method="post" role="form" >
									<div class="form-group">
                                                                            <label>Full Name</label>
										<input type="text" name="name" id="username" tabindex="1" class="form-control" placeholder="Full Name" value="">
									</div>
                                                                        <div class="form-group">
                                                                            <label>Date Of Birth</label>
                                                                                <input type="date" name ="dob" id="dob" tabindex="1" class="form-control" placeholder="Date of Birth" value="<?php echo date("Y-m-d");?>">
                                                                        </div>
									<div class="form-group">
                                                                            <label>Email</label>
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
                                                                        <div>
                                                                            <label>Marital Status</label>
                                                                            </br>
                                                                            <select id="married">
                                                                                <option value ="S">Single</option>
                                                                                <option value="M">Married</option>
                                                                                <option value="D">Divorced</option>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div>
                                                                            <label>Citizenship</label>
                                                                            </br>
                                                                            <select id="citizen">
                                                                                <option value ="S">Singaporean</option>
                                                                                <option value="PR">Permanent Resident</option>
                                                                                <option value="O">Other</option>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                    
                                                                        <div>
                                                                            <label>Income Status per month </label>
                                                                            </br>
                                                                            <select id="income">
                                                                                <option value ="u">Unemployed</option>
                                                                                <option value ="vl">Below $700</option>
                                                                                <option value="l">$701 - $1500</option>
                                                                                <option value="m">$1501 - $3000</option>
                                                                                <option value="h">$3001 - $5000</option>
                                                                                <option value="vh">Above $5000</option>
                                                                            </select>
                                                                         
                                                                        <div>
                                                                            <label>First Time Buyer Status</label>
                                                                            </br>
                                                                            <input type ="radio" name="firsttime" value="yes" checked>Yes<br>
                                                                            <input type="radio" name="firsttime" value="no">No
                                                                        </div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
                                                                    
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
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
    </body>
</html>
