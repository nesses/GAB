<?php
/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/plungerclock/views/dashBoard.php';

require_once 'modules/plungerclock/PlungerclockController.php';
require_once 'lib/plungerclock.table.db.php';
class plungerclock  {
    
    private $views = ['dashBoard'];
    
    private $actions = ['dashBoard' => ['offset','page','date','day']];
    
    private $parameters;
    
    public function __construct($sessionController) {        
        GABLogger::debug(__CLASS__);
        $this->controller = new PlungerclockController($sessionController);
        $this->controller->registerModuleActions($this->actions);
        $this->controller->init($this->views[0]);
        $this->parameters = $this->controller->fetchParams();
        if(!$this->controller->getError()) {
            $command=$this->controller->getActionCommand();
            if(!$command)
                $command = $this->controller->getViewCommand();
            $this->$command();
        } else echo "Error gefunden !!!!!!!:::!:!::!::!::::".$this->controller->getError();
  
    } 
    public function dashBoard() {
        //brauchen beide
        $groups_id = $this->controller->getSessionUser()['groups_id'];
        $users_id = $this->controller->getSessionUser()['id'];
        
        //WORKTIMEINFO
        $date = $this->parameters['date'];
        $day = $this->parameters['day'];
        
        $dash=new dashBoard();
        
        
        if(!$date) {
            $today = date('d.m.Y');
            $this->controller->setParam('date',time());
        } else {
            $today = date('d.m.Y',$date);
            if($day) {
                if($day == 'back')
                    $this->controller->setParam('date',strtotime($today)-(60*60*24));
                else
                    $this->controller->setParam('date',strtotime($today)+(60*60*24));
                $this->controller->setParam('day','');
                $this->controller->redirect($this->controller->getView());
            }
        }
        $pclockTable = new PlungerclockTable();
        $commingstamps = $pclockTable->getStamps($users_id,"$today",'1');
        $goingstamps = $pclockTable->getStamps($users_id,"$today",'0');
        
        $dash->WorktimeInfo()->setStamps($commingstamps,$goingstamps);
        
        //PRESENT BUDDIES
        $offset = 6;
        $page = $this->parameters['page'];
        $pages = ceil($pclockTable->countWorkingUsers($groups_id)/$offset);
        
        if($page == -1)
            $page = $pages-1;
        elseif($page == $pages)
            $page = 0;
        
        $index = $page*$offset;
        $buddies = $pclockTable->getWorkingUsers($groups_id);
        $dash->PresentBuddies()->setBuddies($buddies);
        $dash->PresentBuddies()->setPage($page,$pages);
        
 
        $dash->display();
        
    }
    public function stamp() {
        $pclockTable = new PlungerclockTable();
        
        if(isset($_POST['stamp'])) {
            $last_stamp_id = $pclockTable->getLastStatusByUserId($_SESSION['user']['id']);
            
            //toggle stamp because you can not come to work twice
            if($last_stamp_id == 0)
                $stamp_id = '1'; 
            elseif($last_stamp_id == 1)
                $stamp_id = '0';
            
            $pclockTable->insertStamp($_SESSION['user']['id'],$stamp_id);  
            
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
        }
        
    }
    public function stampforget() {
        echo "STAMPFORGET";
    }
    
    
    
}
    
