<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ViewController {
     
    private $sessionController;
    
    private $error;
    public function __construct($sessionController,$views,$debug=false) {
        $this->sessionController = $sessionController;
        $this->error = $this->sessionController->getError();
        
        if($debug) {
            echo "<br>View :: ".$sessionController->getView();
            //die;
        }
        if(!in_array($sessionController->getView(), $views)) {
            if($debug) {
                echo "<br><b>NOT FOUND<b>";
                
            }
            echo '<script type="text/javascript">window.location="index.php?module='.$sessionController->getModule().'&view='.$views[0].'"</script>';
        
        } else {
            $view = $sessionController->getView();
            try {
                    $this->$view();
                    
                } catch (Throwable $e) {}
        } 
        
    }
    public function mkInt($dbl) {
        return round($dbl,0);
    }
    public function getError() {
        return $this->error;
    }
}
