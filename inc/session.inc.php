<?php
require_once "inc/conf.inc.php";

session_start();

if(isset($_GET['module'])) {
    $_SESSION['module'] = $_GET['module'];
} else 
    $_SESSION['module'] = 'login';

if(isset($_GET['view']))
    $_SESSION['view'] = $_GET['view'];
else
    $_SESSION['view'] = '';


if(isset($_GET['action'])) 
    $_SESSION['action'] = $_GET['action'];
else 
    $_SESSION['action'] = '';



?>