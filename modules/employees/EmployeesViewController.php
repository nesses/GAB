<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
require_once 'lib/user.table.db.php';
require_once 'lib/groups.table.db.php';
require_once 'lib/rights.table.db.php';
class EmployeesViewController extends SessionController {
    private $smarty;
    
    private $views = ['listView','editView'];
    
    private $userTable;
    private $groupsTable;
    private $rightsTable;
            
    public function __construct($smarty,$view) {
        
        if(!in_array($view, $this->views)) {
            echo "NO SUCH VIEW :: $view";
            //$_SESSION['view'] = 'listView';
            //die;
            //echo '<script type="text/javascript">window.location="index.php?module=employees"</script>';
        
        }
        
        parent::__construct($open_mod=false);
        //$this->view = $view;
        $this->smarty = $smarty;
        $this->smarty->assign('view',$this->getView());
        $this->smarty->assign('module',$this->getModule());
        
        try {
            $this->$view();
        } catch (Throwable $e) {}
        
    }
    public function listView() {
        
        $this->userTable = new UserTable();
        $users = $this->userTable->getAll();
            
        $this->groupsTable = new GroupsTable();
        $groups = $this->groupsTable->getAll();
        
        $this->rightsTable = new RightsTable();
        $rights = $this->rightsTable->getAll();
        
        $this->smarty->assign('view',$this->getView());
        
        $this->smarty->assign('uid',$_SESSION['user']['id']);
        $this->smarty->assign('rights',$rights);
        $this->smarty->assign('users',$users);
        $this->smarty->assign('groups',$groups);
        
    }
    public function editView() {
        $this->userTable = new UserTable();
        $users = $this->userTable->getAll();
            
        $this->groupsTable = new GroupsTable();
        $groups = $this->groupsTable->getAll();
        
        $this->rightsTable = new RightsTable();
        $rights = $this->rightsTable->getAll();
        
        // $this->assign('users',$users);
        //$this->assign('user_work_stat',$usr_wrk_stat);
        $this->smarty->assign('uid',$_SESSION['user']['id']);
        $this->smarty->assign('rights',$rights);
        $this->smarty->assign('users',$users);
        $this->smarty->assign('groups',$groups);
    }
}
