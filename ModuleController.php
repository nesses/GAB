<?php
class ModuleController {
    private $sessionController;
    
    public function __construct($sessionController) {
        $this->sessionController = $sessionController;
        if($debug) {
            echo "<br>View :: ".$sessionController->getView();
            //die;
        }
        if($sessionController->amIAllowed()) {
      ->      //first look, is there an Action because if so Controller will
              //redirect you after execution 
              if($sessionController->getAction() && !in_array($sessionController->getAction(),$actions)) {
                      echo "<br>NO ACTION :: ".$sessionController->getAction();
              } else $execute = $sessionController->getAction();
              //execute view when there is no action given
              //Action causes controller to redirect so
              //this will only be affected when there is no action
              if(!in_array($sessionController->getView(), $views)) {
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
          }
}