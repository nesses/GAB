<?php
class ModuleController {
    private $sessionController;
    
    private $default_view;
    public function __construct($sessionController) {
        if($sessionController->getView() == '')
            $sessionController->setView($this->default_view);
        
        $this->sessionController = $sessionController;
        if($debug) {
            echo "<br>View :: ".$sessionController->getView();
            //die;
        }
        echo $sessionController->getView()."sdas";
        if($sessionController->amIAllowed()) {
            //first look, is there an Action because if so Controller will
            //redirect you after execution 
            if($sessionController->getAction() && !in_array($sessionController->getAction(),$sessionController->getViewActions())) {
                echo "<br>NO ACTION :: ".$sessionController->getAction();
            } else $execute = $sessionController->getAction();
            
                //execute view when there is no action given
                //Action causes controller to redirect so
                //this will only be affected when there is no action
            if($sessionController->getAction() || $sessionController->getView() && !in_array($sessionController->getView(), $sessionController->getModuleViews())) {
                echo "<br>NO VIEW";
            } else $execute = $sessionController->getView();
            if($execute) {
            //execute wether action or view depending on
            //lines before...
            //by defaulf function has to be defined in 
            //[MODULE]Controller e.g 
            //LoginController(extends ModuleController)->$'execute'
                try {
                      $this->$execute();
                } catch (Throwable $e) {}
            }
        } else { 
            echo "<br>You are not allowed to do this::::<br>";
        }
        
    }
    public function setDefaultView($viewName) {
        $this->default_view = $viewName;
    }
}