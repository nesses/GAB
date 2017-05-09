<?php
/*
 * @author Matthias Grotjohann
 */

require_once "inc/logger.php";

require_once 'GAB.php';
session_start();

$GAB = new GAB($debug = false);
$GAB->HORIDO();




