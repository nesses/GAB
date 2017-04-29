<?php
require_once 'lib/user.table.db.php';
require_once 'lib/groups.table.db.php';
require_once 'lib/rights.table.db.php';

require_once 'modules/module.mother.php';

class employees extends ModuleMother {

    private $userTable;
    private $groupsTable;
    private $rightsTable;
    
    private $fields = [ 'id'            =>  'int',
                        'username'      =>  'text',
                        'password'      =>  'password',
                        'name'          =>  'text',
                        'surname'       =>  'text',
                        'group_id'      =>  'combobox',
                        'rights_id'     =>  'combobox',
                        'creator_id'    =>  'hidden',
                        'created'       =>  'hidden',
                        'alterer_id'    =>  'hidden',
                        'status'        =>  'hidden'];
    
    public function __construct($view,$action) {
        parent::__construct();
        if($this->isAuthenticated() == 1) {
            if($this->initView($view) == 1) {             
                $this->executeAction($action);
    
            }
            $this->display('templates/modules/employees.tpl');
        } else {
            echo "not logged in";
        }
    }
    private function initView($view) {
        if($view != null && $view != '') { 
                $this->groupsTable = new GroupsTable();
                $this->groupsTable->loadTable();
                $groups = $this->groupsTable->asArray();

                $this->rightsTable = new RightsTable();
                $this->rightsTable->loadTable();
                $rights = $this->rightsTable->asArray();

                $this->userTable = new UserTable();
                $this->userTable->loadTable();
                $colTitles = $this->userTable->getColTitles();
                $users = $this->userTable->asArray();

                $this->assign('view',$view);
                $this->assign('fields', $this->fields);
                $this->assign('colTitles', $colTitles); 
                
                if($view == 'createNew') {
                    $this->assign('groups',$groups);
                    $this->assign('rights',$rights);
                    $this->assign('uid',$_SESSION['user']['id']);
                } elseif ($view == 'listAll') {
                    $user = $this->userTable->asArray();
                    $this->assign('groups',$groups);
                    $this->assign('users',$users);
                    $this->assign('rights',$rights);
                } else
                    $this->assign('error', "View not found::");
                
                return 1;
            }
            return 0;
    }
    private function executeAction($action) {
        if($action != null && $action != '') {
            try {
                $this->$action();
                return 1;
            } catch (Throwable $e) {
                $this->assign('error','No such action :: '.$action);
            }
        }
        
        return 0;
    }
    public function save() {
        print_r($_POST);//$this->userTable->
    }
}
?>