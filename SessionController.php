<?php
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";
require_once 'lib/modules.table.db.php';
require_once 'inc/rights.inc.php';


class SessionController {
    
    private $rights;
    
    private $module;
    private $view;
    private $action;
    private $user;
    
    public function __construct($actions,$open_mod=false) {
        
        $this->start();
        
        $this->rights = new Rights();
        

        if(isset($_GET['module'])) {
            $_SESSION['module'] = $_GET['module'];
        } else 
            $_SESSION['module'] = 'login';

        if(isset($_GET['view']))
            $_SESSION['view'] = $_GET['view'];
        else
            $_SESSION['view'] = '';


        if(isset($_GET['action'])) 
            $_SESSION['action'] = $_GET['action'];
        else 
            $_SESSION['action'] = '';


        
        $this->module = $_SESSION['module'];
        $this->view   = $_SESSION['view'];
        $this->action = $_SESSION['action'];
        $this->user   = $_SESSION['user'];
        
        if($open_mod || $this->rights->isAuthenticated($_SESSION['user']['username']) == 1) {
            if($_SESSION['action'] && !in_array($_SESSION['action'],$actions)) {
                $_SESSION['action'] = NULL;
                $_SESSION['ERROR']['No such action'];
                //$this->assign('error','No such action '.$_SESSION['action']);
                //$this->display('templates/error.tpl');
                die;
            //$_POST verursachte die doppelte kacke
            } elseif ($_SESSION['action'] && !$_POST) {
                //$this->assign('error','No parameters set for :: '.$_SESSION['action']);
                //$this->display('templates/error.tpl');
                die;
            }
            if($_SESSION['user']['username'])
            $this->rights->updateLastSeen($_SESSION['user']['username']);


        } else {
                //$this->assign('error',"Keine Berechtigung :: Nicht angemeldet");
                //$this->display('templates/error.tpl');
                die;
        } 
              
            
        
    }
    private function start() {
        session_start();
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
}   

?>