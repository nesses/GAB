<?php
class ModuleController {
    private $error;
    
    private $sessionController;
    
    private $default_view;
    public function __construct($sessionController) {
        if($sessionController->getView() == '')
            $sessionController->setView($this->default_view);
        $this->sessionController = $sessionController;
        if($sessionController->amIAllowed()) {
            //first look, is there an Action because if so Controller will
            //redirect you after execution 
            $execute = $this->checkAction();
            echo $execute;
            //execute view when there is no action given
            //Action causes controller to redirect so
            //this will only be affected when there is no action
            if(!$execute)
                $execute = $this->checkView();
            echo $execute;
            $this->execute($execute);
        } else { 
            echo "<br>You are not allowed to do this::::<br>";
        }
    }
    private function checkAction() {
        
        if(!$this->sessionController->getAction() && !in_array($this->sessionController->getAction(),$this->sessionController->getViewActions())) {
            //echo "<br>NO ACTION :: ".$this->sessionController->getAction();
            return false;
        } else {
            $execute = $this->sessionController->getAction();
            return $execute;
        }
    }
    private function checkView() {
        
        if($this->sessionController->getAction() || $this->sessionController->getView() && !in_array($this->sessionController->getView(), $this->sessionController->getModuleViews())) {
            //echo "<br>NO VIEW";
        } else {
            $execute = $this->sessionController->getView();
            return $execute;
        }
            
    }
    private function execute($command) {
        if($command) {
            //by defaulf function has to be defined in 
            //[MODULE]Controller e.g 
            //LoginController(extends ModuleController)->$'execute'
                try {
                      $this->$command();
                } catch (Throwable $e) {
                    echo "COMMAND NOT FOUND";
                }
            }
    }
    public function setError($error) {
        $this->error = $error;
    }
    public function getError() {
        return $this->error;
    }
    public function setDefaultView($viewName) {
        $this->default_view = $viewName;
    }
}