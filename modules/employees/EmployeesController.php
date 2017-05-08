<?php
require_once 'ModuleController.php';
require_once 'modules/employees/views/ListView.php';   

class EmployeesController extends ModuleController {
    private $sessionController;
    
    private $default_view = 'ListView';
   
    private $usersTable;
    private $groupsTable;
    
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
    
    
    public function __construct($sessionController) {
        $this->setDefaultView($this->default_view);
        $this->sessionController = $sessionController;
        $this->usersTable = new UserTable();
        parent::__construct($sessionController);
    }
    public function main() {
        
    }
    public function ListView() {
        $offset=$this->sessionController->getParams()['offset'];
        $page=$this->sessionController->getParams()['page'];
        $orderby=$this->sessionController->getParams()['orderby'];
        $listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView->setPage($page);
        
        /*
        if(!$offset) {
            $offset = 5;
            $this->sessionController->setParam('offset',$offset);
        }
        if(!$page) {
            $page = 0;
            $this->sessionController->setParam('page',$page);
        }
        $listView = new ListView($this->usersTable);
        
        $users = $this->usersTable->getAll($page*$offset,$offset,$orderby);
        $size = $this->usersTable->countAll();
        
        $listView->assign('module',$this->sessionController->getModule());
        $listView->assign('view',$this->sessionController->getView());
        $listView->assign('offset',$offset);
        $listView->assign('size',$size);
        $listView->assign('users',$users);
        */
        
        $listView->display("templates/items/ListView.tpl");
    }
    public function editView() {
        echo "editView";
    }
    public function save() {
        $this->userTable=new UserTable();
        
        if(isset($_POST['_action'])) {
            unset($_POST['_action']);
            unset($_POST['id']);
            $_POST['creator_id'] = $_SESSION['user']['id'];
            $_POST['alterer_id'] = $_SESSION['user']['id'];
            $_POST['password'] = md5($_POST['password']);
            $_POST['userstatus_id'] = 4;
            $date = new DateTime('now');
            $date->format('Y-m-d H:i:s');
            $_POST['created'] = $date->format('Y-m-d H:i:s');

            $this->userTable->addUser($_POST);
            $_SESSION['action'] = null;
        }
        
        echo '<script type="text/javascript">window.location="index.php?module=employees&view=listAll"</script>';
 
    }
}
