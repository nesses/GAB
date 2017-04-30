<?php
$db_type = "SQLite";

$db_conf = "gab.sqlite";

$mysql_conf = [ 'host'      => 'localhost',
                'dbname'    => 'gab',
                'user'      => 'root',
                'passwd'    => ''];

$modules = ARRAY(   "Login" => "login",
                    "Mitarbeiter" => "employees");

$module_keys = array_keys($modules);

?>