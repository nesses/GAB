<?php


/* 
 * @author Matthias Grotjohann
 */
class GABLogger {
    
    
    public static function debug($lines) {
        $debug = "log/debug.log";
        $connection = fopen($debug, "a") or die("Unable to open file!");
        fwrite($connection, $lines."\n");
        fclose($connection);
    }
    
    public static function sql($lines) {
        $connection = fopen(self::sql, "a") or die("Unable to open file!");
        fwrite($connection, $lines."\n");
        fclose($connection);
    }
}
