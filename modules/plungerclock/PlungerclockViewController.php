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
    
    private $params = ['dashBoard' => ['page','day','offset','date']];
     
    public function __construct($sessionController,$pclockTable,$debug=false) {
        
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        $this->pclockTable = $pclockTable;
        
        if($debug)
            echo "<b>[DBG]Plungerclock</b>";
        parent::__construct($sessionController,$this->views,$this->params,$debug);
        
        
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        
        
        $page = $this->sessionController->getParams()['page'];
        $day = $this->sessionController->getParams()['day'];
        $date = $this->sessionController->getParams()['date'];
        if(!$date)
            $this->sessionController->setParam('date',time());
        $offset = 6;
        
        $groups_id = $this->sessionController->getUser()['groups_id'];
        $users_id = $this->sessionController->getUser()['id'];
        $pages = ceil($this->usersTable->countGroupId($groups_id)/$offset);
        
        if($page == -1)
            $page = $pages-1;
        if($page >= $pages)
            $page=0;
        $index = $page*$offset;
        
        $buddies = $this->usersTable->byGroupId($groups_id, $index, $offset);
        
        
        $today = date('Y-m-d');
        
        $commingstamps = $this->pclockTable->getStamps($users_id,"$today",'1');
        $goingstamps = $this->pclockTable->getStamps($users_id,"$today",'0');
        
        
        foreach($commingstamps as $nr => $stamp) {
            if($goingstamps[$nr]['timestamp']) {
                $secs_between = strtotime($goingstamps[$nr]['timestamp'])-strtotime($stamp['timestamp']);
                $today_secs += $secs_between;
                $times[$nr] = date('H:i:s',strtotime("1970/1/1")+$secs_between);
            }
        }
        
        if(sizeof($commingstamps) > sizeof($goingstamps)) {
            $today_secs += strtotime(date('H:i:s'))-strtotime($commingstamps[sizeof($commingstamps)-1]['timestamp']);
            $wtStat = 1;
        }
        
        $summary_time = date('H:i:s',strtotime("1970/1/1")+$today_secs);
        
        $dash=new dashBoard();
        $dash->getPresentBuddies()->init($buddies, $page, $pages);
        $dash->getWorktimeInfo()->init($wtStat,$commingstamps,$goingstamps,$times,$summary_time);
        
        
        
        
        $dash->display();
        
    }
}