<?php

/* 
 * @author Matthias Grotjohann
 */

class ActionController {
    public function __construct($action,$actions) {
        
        if($action != null && $action != '') {
            if($action && !in_array($action,$actions)) {
                $_SESSION['action'] = NULL;
                $_SESSION['ERROR'] = 'No such action';
                echo "<br>NO ACTION :: $action";
                
            //$_POST verursachte die doppelte kacke
            
            }elseif($action != '') {
                    
                try {
                    $this->$action();
                    
                } catch (Throwable $e) {}
            }
            
            
            
 	}
    }
}