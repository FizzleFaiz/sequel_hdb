<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_unset();
session_start();
session_destroy();
unset($_SESSION['id']);
unset($_SESSION['pwd']);
unset($_SESSION['seller']);
unset($_SESSION['name']);
$_SESSION = array();
header('Location: login_form.php');
?>