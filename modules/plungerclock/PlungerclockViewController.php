<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
class PlungerclockViewController extends SessionController {
    private $smarty;
    
    private $view;
    private $views = ['dashBoard'];
            
    public function __construct($view) {
        
        if(!in_array($view, $this->views)) {
            echo "NO SUCH VIEW :: $view";
            $_SESSION['view'] = 'dashBoard';
            //die;
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
        }
        
        parent::__construct($open_mod=false);
        
        $this->view = $view;
    }
    public function getView() {
        return $this->view;
    }
    public function dashBoard() {
        $this->pclockTable = new PlungerclockTable();
        $this->usersTable = new UserTable();
        
        
        $stamps = $this->pclockTable->getAllByUserId($_SESSION['user']['id']);
        $usr_wrk_stat = $this->isUserWorking();
        
        
        $users = $this->usersTable->getUsersByGroupId($_SESSION['user']['groups_id']);
        
        $this->assign('myself',$this->usersTable->getUserByUsername($_SESSION['user']['username']));
        
    }
}
