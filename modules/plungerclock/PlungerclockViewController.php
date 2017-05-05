<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
require_once 'views/dashBoard.php';
class PlungerclockViewController extends ViewController {
    private $sessionController;
    
    private $views = ['dashBoard'];
            
    public function __construct($sessionController,$smarty,$debug=false) {
        
        $this->sessionController = $sessionController;
        if($debug)
            echo "<b>[DBG]Plungerclock</b>";
        parent::__construct($sessionController,$this->views,$debug);
        
        
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        
        $page = $_GET['page'];
        
        $dash=new dashBoard();
        $dash->assignValues($this->sessionController->getUser()['name'], $page);
        $dash->display('templates/modules/plungerclock.tpl');

        
    }
}
