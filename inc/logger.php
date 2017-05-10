<?php


/* 
 * @author Matthias Grotjohann
 */
class GABLogger {
    
    
    public static function debug($lines) {
        
        $debug = "_gitignore/logs/debug.log";
        $connection = fopen($debug, "a") or die("Unable to open file!");
        fwrite($connection, $lines."\n");
        fclose($connection);
    }
    
    public static function sql($lines) {
        $debug = "_gitignore/logs/sql.log";
        $connection = fopen($debug, "a") or die("Unable to open file!");
        fwrite($connection, $lines."\n");
        fclose($connection);
    }   
}
