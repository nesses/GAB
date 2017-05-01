<?php
$db_type = "SQLite";

$db_conf = "gab.sqlite";

$mysql_conf = [ 'host'      => 'localhost',
                'dbname'    => 'gab',
                'user'      => 'root',
                'passwd'    => '08xb7cX2'];

$modules = ARRAY(   "Login" => "login",
                    "Mitarbeiter" => "employees");

$module_keys = array_keys($modules);
//hakkooo
?>