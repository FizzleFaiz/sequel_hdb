/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
var register = angular.module("Register", []);
var settings = angular.module("Settings", []);
            register.controller("PasswordController", function($scope) {

                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                $scope.passwordStrength = {
                    "float": "left",
                    "width": "100%",
                    "height": "10px",
                    "margin-bottom": "5px"
                };
                
                $scope.password1Strength = {
                    "float": "left",
                    "width": "100%",
                    "height": "10px",
                    "margin-bottom": "5px"
                };

                $scope.analyze = function(value) {
                    if(strongRegex.test(value)) {
                        $scope.passwordStrength["background-color"] = "green";
                        $scope.passwordIndicatorField = 'Strong';
                    } else if(mediumRegex.test(value)) {
                        $scope.passwordStrength["background-color"] = "orange";
                        $scope.passwordIndicatorField = 'Medium';
                    } else {
                        $scope.passwordStrength["background-color"] = "red";
                        $scope.passwordIndicatorField = 'Weak';
                    }
                };
                $scope.analyze1 = function(value) {
                    if(strongRegex.test(value)) {
                        $scope.password1Strength["background-color"] = "green";
                        $scope.passwordIndicatorField1 = 'Strong';
                    } else if(mediumRegex.test(value)) {
                        $scope.password1Strength["background-color"] = "orange";
                        $scope.passwordIndicatorField1 = 'Medium';
                    } else {
                        $scope.password1Strength["background-color"] = "red";
                        $scope.passwordIndicatorField1 = 'Weak';
                    }
                };

            });
            
            settings.controller("PasswordController", function($scope) {

                var strongRegex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
                var mediumRegex = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9])))(?=.{6,})");

                $scope.passwordStrength = {
                    "float": "left",
                    "width": "100%",
                    "height": "10px",
                    "margin-bottom": "5px"
                };
                
                $scope.password1Strength = {
                    "float": "left",
                    "width": "100%",
                    "height": "10px",
                    "margin-bottom": "5px"
                };

                $scope.analyze = function(value) {
                    if(strongRegex.test(value)) {
                        $scope.passwordStrength["background-color"] = "green";
                        $scope.passwordIndicatorField = 'Strong';
                    } else if(mediumRegex.test(value)) {
                        $scope.passwordStrength["background-color"] = "orange";
                        $scope.passwordIndicatorField = 'Medium';
                    } else {
                        $scope.passwordStrength["background-color"] = "red";
                        $scope.passwordIndicatorField = 'Weak';
                    }
                };
                $scope.analyze1 = function(value) {
                    if(strongRegex.test(value)) {
                        $scope.password1Strength["background-color"] = "green";
                        $scope.passwordIndicatorField1 = 'Strong';
                    } else if(mediumRegex.test(value)) {
                        $scope.password1Strength["background-color"] = "orange";
                        $scope.passwordIndicatorField1 = 'Medium';
                    } else {
                        $scope.password1Strength["background-color"] = "red";
                        $scope.passwordIndicatorField1 = 'Weak';
                    }
                };

            });
         

