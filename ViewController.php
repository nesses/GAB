<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ViewController {
     
    private $sessionController;
    
    public function __construct($sessionController,$views,$debug=false) {
        //print_r($this->getModule());
        if($debug) {
            echo "<br>View :: ".$sessionController->getView();
            //die;
        }
        if(!in_array($sessionController->getView(), $views)) {
            if($debug) {
                echo "<br><b>NOT FOUND<b>";
                
            }
            echo '<script type="text/javascript">window.location="index.php?module='.$sessionController->getModule().'&view=main"</script>';
        
        } else {
            $view = $sessionController->getView();
            try {
                    $this->$view();
                    
                } catch (Throwable $e) {}
        }
        
        
        
    }
}
