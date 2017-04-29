<?php
require_once 'lib/user.table.db.php';
require_once 'lib/groups.table.db.php';
require_once 'lib/rights.table.db.php';

require_once 'modules/module.mother.php';

class employees extends ModuleMother {

    private $userTable;
    private $groupsTable;
    private $rightsTable;
    
    private $viewTitles = [ 'createNew' => 'Hinzufügen',
                            'listAll'   => 'Übersicht'];
    
    private $fieldVisibility = ["id"                =>  1,
                                "username"          =>  1,
                                "password"          =>  0,
                                "name"              =>  1,
                                "surname"           =>  1,
                                "rights_id"         =>  0,
                                "groups_id"         => 1,
                                "creator_id"        =>  0,
                                "created"           =>  0,
                                "alterer_id"        =>  0,
                                "userstatus_id"     =>  1];
    
    private $fieldEntities =   ["id"            =>  'number',
                                "username"      =>  'string',
                                "password"      =>  'password',
                                "name"          =>  'string',
                                "surname"       =>  'string',
                                "rights_id"     =>  'combobox',
                                "groups_id"     =>  'combobox',
                                "creator_id"    =>  'combobox',
                                "created"       =>  'date',
                                "alterer_id"    =>  'combobox',
                                "userstatus_id" =>  'combobox'];    
    
    private $fieldTitles =  [   'id'            =>  'ID',
                                'username'      =>  'Benutzername',
                                'password'      =>  'Password',
                                'name'          =>  'Name',
                                'surname'       =>  'Vorname',
                                'groups_id'     =>  'Gewerk',
                                'rights_id'     =>  'Rechte',
                                'creator_id'    =>  'Ersteller',
                                'created'       =>  'Erstellt',
                                'alterer_id'    =>  'Bearbeiter',
                                'userstatus_id' =>  'Status'];
    
    public function __construct($view,$action) {
        parent::__construct();
        if($this->isAuthenticated() == 1) {
            if($this->initView($view) == 1) {
                if($this->executeAction($action) == 1) {
                    
                } else 
                    $this->assign('error','No such action');
    
            } else
                $this->assign('error', "View not found::"); 
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
            
            $dataTypes = $this->userTable->getColTypes();
            $users = $this->userTable->asArray();

            $this->assign('view',$view);
            $this->assign('viewTitles',$this->viewTitles);
            
            $this->assign('fieldEntities', $this->fieldEntities);
            $this->assign('fieldTitles', $this->fieldTitles);
            $this->assign('fieldVisibility', $this->fieldVisibility);
            $this->assign('dataTypes', $dataTypes);
               
            if($view == 'createNew') {
                $this->assign('groups',$groups);
                $this->assign('rights',$rights);
                $this->assign('uid',$_SESSION['user']['id']);
            } elseif ($view == 'listAll') {
                $this->assign('groups',$groups);
                $this->assign('users',$users);
                $this->assign('rights',$rights);
            } else 
                return 0;
                

            return 1;
        }
        return 0;
    }
    private function executeAction($action) {
        if($action != null && $action != '') {
            if(method_exists($this,"$action")) {
                $this->$action();
                return 1;
            } else 
                return 0;
        }
        
        return 1;
    }
    public function save() {
        print_r($_POST);//$this->userTable->
    }
}
?>