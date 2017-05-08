<?php
require_once 'ModuleController.php';
require_once 'modules/employees/views/ListView.php';   

class EmployeesController extends ModuleController {
    private $sessionController;
    
    private $default_view = 'ListView';
   
    private $usersTable;
    
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
        $listView = new ListView($this->usersTable);
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
