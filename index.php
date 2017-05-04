<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'GAB.php';
session_start();
print_r($_SESSION);
$GAB = new GAB($debug = true);
$GAB->HORIDO();




?>




