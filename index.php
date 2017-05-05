<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'GAB.php';
session_start();

/*
 * debug enables SESSION dumping 
 */
$GAB = new GAB($debug = true);
$GAB->HORIDO();




