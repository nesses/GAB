<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
require_once 'modules/plungerclock/views/dashBoard.php';
class PlungerclockViewController extends ViewController {
    
    private $sessionController;
    private $usersTable;
    
    private $views = ['dashBoard'];
     
    public function __construct($sessionController,$debug=false) {
        
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        
        if($debug)
            echo "<b>[DBG]Plungerclock</b>";
        parent::__construct($sessionController,$this->views,$debug);
        
        
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        
        $offset = 5;
        $page = $_GET['page'];
        $groups_id = $this->sessionController->getUser()['groups_id'];
        
        $pages = $this->mkInt($this->usersTable->countGroupId($groups_id)/$offset,0);
        if($page == -1)
            $page = $pages-1;
        if($page >= $pages)
            $page=0;
        $index = $page*$offset;
        
        $buddies = $this->usersTable->byGroupId($groups_id, $index, $offset);
        
        $wtStat = 1;
        
        $dash=new dashBoard();
        $dash->initPresentBuddies($buddies, $page, $pages);
        $dash->initWorktimeInfo($wtStat);
        $dash->display();
        /*
        $WtInfo = new WorktimeInfo();
        $WtInfo->display('templates/');
        */
        
    }
}