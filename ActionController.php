<?php
/* 
 * @author Matthias Grotjohann
 */
class ActionController {
    
    private $sessionController;
    
    public function __construct($sessionController,$actions) {
        $this->sessionController = $sessionController;
        if($debug) {
            echo "<br>View :: ".$sessionController->getView();
            //die;
        }
                   
        if($sessionController->getAction() != null && $sessionController->getAction() != '') {
            if($sessionController->getAction() && !in_array($sessionController->getAction(),$actions)) {
                $_SESSION['action'] = NULL;
                
                echo "<br>NO ACTION :: ".$sessionController->getAction();
                
            //$_POST verursachte die doppelte kacke
            
            }elseif($this->sessionController->getAction() != '') {
                $action = $this->sessionController->getAction();
                try {
                    $this->$action();
                    
                } catch (Throwable $e) {}
            }            
        }     
    }
    public function setError($error) {
          $this->sessionController->setError($error);
          //$this->error = $error;
    }
    //public function getError() {
    //      return $this->error;
    //}
    
}