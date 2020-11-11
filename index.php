<?php
//this page is like a middleware, to redirect the request if the user is on the database
session_start();
if(!empty($_SESSION["userId"])) {
    require_once './view/dashboard.php';
} else {
    require_once './view/login-form.php';
}
?>