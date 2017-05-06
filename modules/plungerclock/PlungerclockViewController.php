<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ViewController.php';
require_once 'modules/plungerclock/views/dashBoard.php';
class PlungerclockViewController extends ViewController {
    
    private $sessionController;
    private $usersTable;
    private $pclockTable;
    
    private $views = ['dashBoard'];
    
    private $params = ['dashBoard' => ['page','date','day']];
     
    public function __construct($sessionController,$pclockTable) {
        
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        $this->pclockTable = $pclockTable;
        
        parent::__construct($sessionController,$this->views,$this->params);
        
        
    }
    public function dashBoard() {
        //brauchen beide
        $groups_id = $this->sessionController->getUser()['groups_id'];
        $users_id = $this->sessionController->getUser()['id'];
        
        //WORKTIMEINFO
        $date = $this->sessionController->getParams()['date'];
        $day = $this->sessionController->getParams()['day'];
        
        $dash=new dashBoard();
        
        
        if(!$date) {
            $today = date('d.m.Y');
            $this->sessionController->setParam('date',time());
        } else {
            $today = date('d.m.Y',$date);
            if($day) {
                if($day == 'back')
                    $this->sessionController->setParam('date',strtotime($today)-(60*60*24));
                else
                    $this->sessionController->setParam('date',strtotime($today)+(60*60*24));
                $this->sessionController->setParam('day','');
                $this->sessionController->redirect();
            }
        }
        $commingstamps = $this->pclockTable->getStamps($users_id,"$today",'1');
        $goingstamps = $this->pclockTable->getStamps($users_id,"$today",'0');
        $dash->WorktimeInfo()->setStamps($commingstamps,$goingstamps);
        
        //PRESENT BUDDIES
        $offset = 6;
        $page = $this->sessionController->getParams()['page'];
        $pages = ceil($this->usersTable->countGroupId($groups_id)/$offset);
        
        if($page == -1)
            $page = $pages-1;
        elseif($page == $pages)
            $page = 0;
        
        $index = $page*$offset;
        $buddies = $this->pclockTable->getWorkingUsers($groups_id);
        print_r($buddies);
        $dash->PresentBuddies()->setBuddies($buddies);
        $dash->PresentBuddies()->setPage($page,$pages);
        
 
        $dash->display();
        
    }
}