<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
class PlungerclockViewController extends SessionController {
    private $smarty;
    
    private $view;
    private $views = ['dashBoard'];
            
    public function __construct($smarty,$view) {
        
        if(!in_array($view, $this->views)) {
            echo "<br>PLUNGERCLOCK : NO VIEW :: $view";
            //$_SESSION['view'] = 'dashBoard';
            //die;
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock&view=dashBoard"</script>';
        
        } else {
            parent::__construct($open_mod=false);
            $this->view = $view;
    
        }
        
        
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        
        echo $this->getUser();
        $stamps = $this->pclockTable->getAllByUserId($this->getUser()['id']);
        $usr_wrk_stat = $this->isUserWorking();
        
        
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        $this->assign('myself',$this->usersTable->getUserByUsername($_SESSION['user']['username']));
        
    }
}
