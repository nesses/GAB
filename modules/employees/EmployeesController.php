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
    public function ListView() {
        $listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView->setModule($this->sessionController->getModule());
        
        $this->sessionController->fetchParams();
        $offset=$this->sessionController->getParams()['offset'];
        if(!$offset) {
            $offset = $listView->getDefaultOffset(); 
        }
        $listView->setOffset($offset);
        
        $page=$this->sessionController->getParams()['page'];
        $listView->setPage($page);
        
        $orderby=$this->sessionController->getParams()['orderby'];
        
        $size = $this->usersTable->countAll();
        $pageCount = ceil($size/$offset);
        
        $listView->setPageCount($pageCount);
        
        
        $content = $this->usersTable->getAll(($page-1)*$offset,$offset,$orderby);
        $listView->setContent($content);
        
        $listView->show();
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
