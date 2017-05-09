<?php

require_once 'modules/employees/EmployeesController.php';
require_once 'modules/module.php';
require_once 'lib/employees.table.db.php';
class employees extends Module {
    
    private $controller;
    private $fieldVisibility =  ['id'               => 0, 
                                 'user_id'          => 1, 
                                 'name'             => 1, 
                                 'surname'          => 1,
                                 'group_id'         => 0,
                                 'tel'              => 0,
                                 'mobile'           => 0,
                                 'mail'             => 0,
                                 'street'           => 0,
                                 'zip'              => 0,
                                 'city'             => 0,
                                 'workaction_id'    => 1,
                                 'speechcoursedays' => 0,
                                 'workaction_beginn'=> 1,
                                 'workaction_end'   => 1,
                                 'timeaddon_end'    => 1,
                                 'created'          => 0,
                                 'creator_id'       => 0,
                                 'birthday'         => 1,
                                 'jobcenterid'      => 1,
                                 'handicaped'       => 0,
                                 'pillflat'         => 0,
                                 'bank_id'          => 0,
                                 'bic'              => 0,
                                 'iban'             => 0,
                                 'accountowner'     => 0,
                                 'nationality_id'   => 0,
                                 'anrede_id'        => 0];
    
    private $fieldTitles =      ['id'               => "ID", 
                                 'user_id'          => "User", 
                                 'name'             => "Name", 
                                 'surname'          => "Nachname",
                                 'group_id'         => "Rechte",
                                 'tel'              => "Tel.:",
                                 'mobile'           => "Mobil",
                                 'mail'             => "e-Mail",
                                 'street'           => "Strasse",
                                 'zip'              => "PLZ",
                                 'city'             => "Ort",
                                 'workaction_id'    => "Maßnahme",
                                 'speechcoursedays' => "Sprachkurs",
                                 'workaction_beginn'=> "Beginnt",
                                 'workaction_end'   => "Endet",
                                 'timeaddon_end'    => "Verlängerung",
                                 'created'          => "Erstellt",
                                 'creator_id'       => "Ersteller",
                                 'birthday'         => "Geb.Datum",
                                 'jobcenterid'      => "Jobcenter#",
                                 'handicaped'       => "Schwerbehindert",
                                 'pillflat'         => "Krankenkasse",
                                 'bank_id'          => "Bank",
                                 'bic'              => "BIC",
                                 'iban'             => "IBAN",
                                 'accountowner'     => "Kto.Inhaber",
                                 'nationality_id'   => "Nationalität",
                                 'anrede_id'        => "Anrede"];
    
    private $actions        = [ 'ListView' => [],
                                'EditView' => []];
    
    private $views          = ['ListView','EditView'];
    
    private $params         = ['ListView' => ['page','offset','orderby']];
    
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
        $userTable = new EmployeesTable();
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