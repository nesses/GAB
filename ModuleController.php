<?php
class ModuleController {
    private $error;
    
    private $sessionController;
    
    private $action;
    private $view;
    
    public function __construct($sessionController) {
        $this->sessionController = $sessionController;
        
    }
    public function init($view) {
        //$this->fetchView();
        
        if(!$this->fetchView()) {
            GABLogger::debug("DEF V::".$view);
            //echo "NO VIEW SET SET DEFAULT VIEW:::".$view;
            $this->setView($view);
        }
        
        $this->fetchAction();
        
        if($this->sessionController->amIAllowed($this->action)) {
            
            //first look, is there an Action because if so Controller will
            //redirect you after execution 
            $this->checkAction();
            //execute view when there is no action given
            //Action causes controller to redirect so
            //this will only be affected when there is no action
            $this->checkView();
            
        } else { 
            $this->setError("DENIED :: [#1] VIEW oder ACTION : ".$this->sessionController->getRightsError());
        }
    }
    private function checkAction() {
        if($this->getAction() && !in_array($this->getAction(),$this->getViewActions())) {
            $this->setError("NO SUCH ACTION :: [#2] ".$this->getAction()." ::");;
            GABLogger::debug("Wrong A:".$this->action);
            $this->action = null;
            
        } else {
            $this->action = $this->getAction();
            GABLogger::debug("Got A:".$this->action);
        
        }
    }
    private function checkView() {
        if($this->getView() && !in_array($this->getView(), $this->getModuleViews())) {
            $this->setError("NO SUCH VIEW :: [#3] ".$this->getView()." ::");
            print_r($this->getModuleViews());
            GABLogger::debug("Wrong V:".$this->view);
            
        } else {
            $this->view = $this->getView();
            
            GABLogger::debug("Got V:".$this->view);
        }
            
    }
    
    public function getView() {
        return $this->view;
    }
    public function setView($view) {
        $this->view = $view;
        $_SESSION[$this->getModule()]['view'] = $view;
    }
    public function getAction() {
        return $this->action;
    }
    public function hasPOST() {
        if($_POST)
              return true;
        return false;
    }
    public function hasAction() {
        if($this->action && $this->hasPOST())
            return true;
        return false;
    }
    private function fetchAction() {
        if(isset($_GET['action']) && $_GET['action'] <> $_SESSION[$this->getModule()]['action']) { 
            $_SESSION[$this->getModule()]['HISTORY']['action'][] = $_SESSION[$this->getModule()]['action'];    
            $_SESSION[$this->getModule()]['action'] = $_GET['action'];
            $this->action = $_GET['action'];
            GABLogger::debug("A|".$this->action);
            return true;
            
        } elseif(isset($_GET['action']) && $_GET['action'] == $_SESSION[$this->getModule()]['action']) { 
              $this->action = $_GET['action'];
              //GABLogger::debug("'".$this->action);
              return true;
        } 
        //GABLogger::debug("A-NOTHING FETCHED -FORGETOLD:".$_SESSION[$this->sessionController->getModule()]['action']);
        $_SESSION[$this->getModule()]['action'] = null;
        
        return false;    
        
    }
    private function fetchView() {
        //GABLogger::debug(__FUNCTION__);
        if(isset($_GET['view']) && $_GET['view'] <> $_SESSION[$this->getModule()]['view']) {
            $_SESSION[$this->getModule()]['HISTORY']['view'][] = $_SESSION[$this->getModule()]['view'];
            $_SESSION[$this->getModule()]['view'] = $_GET['view'];
            $this->view = $_GET['view'];
            GABLogger::debug("V|".$this->view);
            return true;
        } else if(isset($_GET['view']) && $_GET['view'] == $_SESSION[$this->getModule()]['view']) {
            $this->view = $_GET['view'];
            //GABLogger::debug("'".$this->view);
            return true;
        } 
        $this->view = $_SESSION[$this->getModule()]['view'];
        //GABLogger::debug("V-NOTHING FETCHED -KEEpOLD:".$this->view);
        if($this->view <> null)
            return true;
        return false;
    }
    public function registerModuleParameters($parameters) {
        if(!$_SESSION[$this->getModule()]['PARAMS'])
            $_SESSION[$this->getModule()]['PARAMS'] = $parameters;
    }
    public function registerModuleActions($actions) {
        //GABLogger::debug("REGISTER".$actions['ListView'][0]);
        //add 'if isset @' to create duoble regitrations
        if(!$_SESSION[$this->getModule()]['ACTIONS'])
            $_SESSION[$this->getModule()]['ACTIONS'] = $actions;
    }
    public function fetchViewParams() {
        $params = $this->getViewParameters();
        foreach ($params as $key => $paramkey) {
            if(isset($_GET[$paramkey])) {
                $_SESSION[$this->getModule()]['VALUES'][$this->getView()][$paramkey] = $_GET[$paramkey];
            }
        }
        return $this->getViewParamValues();
    }
    public function getViewParamValues() {
        return $_SESSION[$this->getModule()]['VALUES'][$this->getView()];
    }
    public function setViewParamValue($name,$data) {
        $_SESSION[$this->getModule()]['VALUES'][$this->getView()][$name] = $data;
    }
    public function getModuleActions() {
        return $_SESSION[$this->getModule()]['ACTIONS'];
    }
    public function getModuleParameters() {
        return $_SESSION[$this->getModule()]['PARAMS'];
    }
    public function getViewActions() {
            if($_SESSION[$this->getModule()]['ACTIONS'][$this->getView()])
                return $_SESSION[$this->getModule()]['ACTIONS'][$this->getView()];
            return Array();
    }
    public function getViewParameters() {
            if($_SESSION[$this->getModule()]['PARAMS'][$this->getView()])
                return $_SESSION[$this->getModule()]['PARAMS'][$this->getView()];
            return Array();
    }
    public function getModuleViews() {
        return array_keys($_SESSION[$this->getModule()]['ACTIONS']);
    }
    public function getActionCommand() {
        return $this->action;
    }
    public function setError($error) {
        $this->error = $error;
    }
    public function getError() {
        return $this->error;
    }
    public function getModule() {
        return $this->sessionController->getModule();
    }
    public function setDefaultView($viewName) {
        $this->default_view = $viewName;
    }
    public function redirect($module,$view) {
        $this->sessionController->redirect($module,$view);
    }
    public function destroySession() {
        $this->sessionController->destroy();
    }
}