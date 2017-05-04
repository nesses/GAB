<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/user.table.db.php';
require_once 'lib/groups.table.db.php';
require_once 'lib/rights.table.db.php';
require_once 'modules/employees/EmployeesActionController.php';
require_once 'modules/employees/EmployeesViewController.php';


class employees {
    
    private $actionController;
    private $viewController;
    private $smarty;
    
    private $viewTitles = [ 'createNew' => 'Hinzufügen',
                            'listAll'   => 'Übersicht'];
    
    private $fieldVisibility = ["id"                =>  1,
                                "username"          =>  1,
                                "password"          =>  0,
                                "name"              =>  1,
                                "surname"           =>  1,
                                "lastseen"          =>  1,
                                "rights_id"         =>  1,
                                "groups_id"         =>  1,
                                "creator_id"        =>  1,
                                "created"           =>  0,
                                "alterer_id"        =>  0,
                                "userstatus_id"     =>  1];
    
    private $fieldEntities =   ["id"            =>  'hidden',
                                "username"      =>  'text',
                                "password"      =>  'password',
                                "name"          =>  'text',
                                "surname"       =>  'text',
                                "lastseen"      =>  'hidden',
                                "rights_id"     =>  'combobox',
                                "groups_id"     =>  'combobox',
                                "creator_id"    =>  'hidden',
                                "created"       =>  'hidden',
                                "alterer_id"    =>  'hidden',
                                "userstatus_id" =>  'hidden'];    
    
    private $fieldTitles =  [   'id'            =>  'ID',
                                'username'      =>  'Benutzername',
                                'password'      =>  'Password',
                                'name'          =>  'Name',
                                'surname'       =>  'Vorname',
                                'lastseen'      =>  'Zuletzt',
                                'groups_id'     =>  'Gewerk',
                                'rights_id'     =>  'Rechte',
                                'creator_id'    =>  'Ersteller',
                                'created'       =>  'Erstellt',
                                'alterer_id'    =>  'Bearbeiter',
                                'userstatus_id' =>  'Status'];
    
    public function __construct($view,$action) {
        $this->actionController = new EmployeesActionController($this->actions);
        $this->viewController = new EmployeesViewController($view);
    }
    public function show() {
        //$this->smarty = new Smarty();
        $this->initView();
        
        $this->smarty->display('templates/modules/employees.tpl');
        
    }
    private function initView() {
        $this->smarty = new Smarty();
            $this->userTable = new UserTable();
            $users = $this->userTable->getAll();
            
            $this->groupsTable = new GroupsTable();
            $groups = $this->groupsTable->getAll();
            
            $this->rightsTable = new RightsTable();
            $rights = $this->rightsTable->getAll();
            
            $this->smarty->assign('view',$this->viewController->getView());
            $this->smarty->assign('viewTitles',$this->viewTitles);
            
            $this->smarty->assign('fieldEntities', $this->fieldEntities);
            $this->smarty->assign('fieldTitles', $this->fieldTitles);
            $this->smarty->assign('fieldVisibility', $this->fieldVisibility);
            $this->smarty->assign('dataTypes', $dataTypes);
               
                $this->smarty->assign('uid',$_SESSION['user']['id']);
                $this->smarty->assign('rights',$rights);
                $this->smarty->assign('users',$users);
                $this->smarty->assign('groups',$groups);
                
}

}
?>