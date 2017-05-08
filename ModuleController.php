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
        $this->fetchView();
        
        $this->fetchAction();
        if($this->getView() == '')
            $this->setView($view);
        echo $this->view;
        if($this->sessionController->amIAllowed()) {
            //first look, is there an Action because if so Controller will
            //redirect you after execution 
            $this->checkAction();
            
            //execute view when there is no action given
            //Action causes controller to redirect so
            //this will only be affected when there is no action
            $this->checkView();
            
            //$this->execute($execute);
        } else { 
            $this->setError("KEINE BERECHTIGUNG :: [#1] VIEW oder ACTION");
        }
        
    }
    private function checkAction() {
        echo "ChkAction:::.$this->action";
        if(!$this->getAction() && !in_array($this->getAction(),$this->getViewActions())) {
            $this->setError("NO SUCH ACTION OR NO ACTION SET :: [#2] ".$this->getAction()." ::");;
        } else {
            $this->action = $this->getAction();
        }
    }
    private function checkView() {
        echo "ChkView:::";
        if($this->getView() && !in_array($this->getView(), $this->getModuleViews())) {
            $this->setError("NO SUCH VIEW OR NO VIEW SET :: [#3]".$this->getView()." ::");
        } else {
            $this->view = $this->getView();
            $this->error = null;
        }
            
    }
    public function getView() {
        return $this->view;
    }
    public function setView($view) {
        $this->view = $view;
        $_SESSION['view'] = $view;
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
        if(isset($_GET['action'])) 
            $_SESSION['action'] = $_GET['action'];
        else 
            $_SESSION['action'] = '';
        $this->action = $_SESSION['action'];
    }
    private function fetchView() {
        
        if(isset($_GET['view']))
            $_SESSION['view'] = $_GET['view'];
        else
            $_SESSION['view'] = '';
        $this->view = $_SESSION['view'];
    }
    
    public function registerModuleActions($actions) {
        //add 'if isset @' to create duoble regitrations
        if(!$_SESSION[$this->sessionController->getModule()]['ACTIONS'])
            $_SESSION[$this->sessionController->getModule()]['ACTIONS'] = $actions;
        //$_SESSION[$this->getModule()]['VIEWS'] = array_keys($actions);
    }
    public function fetchParams() {
        $params = $this->getViewActions();
        foreach ($params as $key => $paramkey) {
            if(isset($_GET[$paramkey])) {
                $_SESSION[$this->getModule()][$paramkey] = $_GET[$paramkey];
            }
        }
    }
    public function getModuleActions() {
        return $_SESSION[$this->getModule()]['ACTIONS'];
    }
    public function getViewActions() {
        
            return $_SESSION[$this->sessionController->getModule()]['ACTIONS'][$this->getView()];
        
    }
    public function getModuleViews() {
        return array_keys($_SESSION[$this->sessionController->getModule()]['ACTIONS']);
    }
    public function getActionCommand() {
        return $this->action;
    }
    public function getViewCommand() {
        return $this->view;
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
    public function redirect($view) {
        $this->sessionController->redirect($module = null,$view);
    }
    public function destroySession() {
        $this->sessionController->destroy();
    }
    
}