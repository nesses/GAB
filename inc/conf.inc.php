<?php
/*
 * @author Matthias Grotjohann
 */
//contains @var $password
require_once '_gitignore/password.php';
$db_type = "MySQL";

$db_conf = [ "SQLite"   =>  ["filename"  => "gab.sqlite"],
             "MySQL"    =>  [ 'host'      => 'localhost',
                              'dbname'    => 'gab',
                              'user'      => 'root',
                              'passwd'    => $password]];

?>