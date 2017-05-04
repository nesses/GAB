<?php
require_once 'lib/modules.table.db.php';
require_once 'Rights.php';


class SessionController {
    
    private $rights;
    private $module;
    private $view;
    private $action;
    private $user;
    
    public function __construct($view,$open_mod=false,$debug = false) {
        
        
        $this->init();
        
        $this->rights = new Rights();
        
        if($debug)
            print_r($_SESSION);
        
        if($open_mod || $this->rights->isAuthenticated($_SESSION['user']['userstatus_id']) == 1) {
            $this->user   = $_SESSION['user'];
        
            if($_SESSION['user']['username'])
            $this->rights->updateLastSeen($_SESSION['user']['username']);
            
        } else {
            //$this->assign('error',"Keine Berechtigung :: Nicht angemeldet");
            //$this->display('templates/error.tpl');
            echo "KEINE BERECHTIGUNG - Modul";
            echo $this->module;
           
            die;
        } 
    }
    public function init() {
        session_start();
        
        $this->fetchModules();
        
        if(isset($_GET['view']))
            $_SESSION['view'] = $_GET['view'];
        //else
          //  $_SESSION['view'] = '';
        
        $this->view = $_SESSION['view'];
        
        if(isset($_GET['action'])) 
            $_SESSION['action'] = $_GET['action'];
        else 
            $_SESSION['action'] = '';
        
        $this->action = $_SESSION['action'];
        
        
    }
    private function fetchModules() {
        if(isset($_GET['module'])) {
            $_SESSION['module'] = $_GET['module'];
        } else 
            $_SESSION['module'] = 'login';
        $this->module = $_SESSION['module'];
            
    }
    public function getUser() {
        return $this->user;
    }
    public function getModule() {
        return $this->module;
    }
    public function getAction() {
        return $this->action;
    }
    public function getView() {
        return $this->view;
    }
    public function setView($view) {
        $this->view = $view;
        $_SESSION['view'] = $view;
    }
    public function Rights() {
        return $this->rights;
    }
    
}   

?>