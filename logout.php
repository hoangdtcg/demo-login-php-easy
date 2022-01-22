<?php
include_once "Auth.php";
$auth = new Auth();
if(isset($_SESSION["user"])){
    $auth->logout();
}