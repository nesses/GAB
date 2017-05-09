<?php

require_once 'modules/employees/EmployeesController.php';
require_once 'modules/module.php';
class employees extends Module {
    
    private $controller;
    
      
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
    
    private $actions        = ['ListView'];
    private $params         = ['ListView' => ['page','offset','orderby']];


    private $views          = ['ListView'];
    
    
    
    private $default_values = ['ListView' => ['page'   => 1,
                                              'offset' => 10,
                                              'orderby'=> 'username']];
    
    
    public function __construct($sessionController) {
        $this->setViews($this->views);
        $this->setActions($this->actions);
        $this->setParams($this->params);
        $this->setDefaultValues($this->default_values);
        $this->controller = new EmployeesController($sessionController);
        
        parent::__construct($this->controller);
    }

    public function ListView() {
        $userTable = new UserTable();
        $listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView->setModule($this->controller->getCurrentModule());
       
        //get offset from url($_GET need to be registered in
        //employee.php)
        $offset=$this->getValues()['offset'];
        
        $page=$this->getValues()['page'];
        $listView->setPage($page);
       
        $listView->setOffset($offset);
      
        $orderby=$this->getValues()['orderby'];
        
        $index = $page-1;
        if($index < 0)
            $index = 0;
        $index = "".$index*$offset."";
        
        $size = $userTable->countAll();
        $pageCount = ceil($size/$offset);
        
        $listView->setPageCount($pageCount);
        
        
        $content = $userTable->getAllJoined($index,$offset,$orderby);
        //print_r($content); 
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
?>