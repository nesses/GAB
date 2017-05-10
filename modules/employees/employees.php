<?php

require_once 'modules/employees/EmployeesController.php';
require_once 'modules/module.php';
require_once 'modules/employees/views/EditView.php';
require_once 'lib/employees.table.db.php';
class employees extends Module {
    
    private $controller;
    
    private $fields =           ['id'               => ['visibility' => 0,'title' => "ID",              'type' => 'hidden'  ], 
                                 'user_id'          => ['visibility' => 1,'title' => "User",            'type' => ''        ], 
                                 'name'             => ['visibility' => 1,'title' => "Name",            'type' => 'text'    ], 
                                 'surname'          => ['visibility' => 1,'title' => "Nachname",        'type' => 'text'    ],
                                 'group_id'         => ['visibility' => 0,'title' => "Rechte",          'type' => ''        ],
                                 'tel'              => ['visibility' => 0,'title' => "Tel.:",           'type' => 'text'    ],
                                 'mobile'           => ['visibility' => 0,'title' => "Mobil",           'type' => 'text'    ],
                                 'mail'             => ['visibility' => 0,'title' => "e-Mail",          'type' => 'text'    ],
                                 'street'           => ['visibility' => 0,'title' => "Strasse",         'type' => 'text'    ],
                                 'zip'              => ['visibility' => 0,'title' => "PLZ",             'type' => 'number'  ],
                                 'city'             => ['visibility' => 0,'title' => "Ort",             'type' => 'text'    ],
                                 'workaction_id'    => ['visibility' => 1,'title' => "Maßnahme",        'type' => ''        ],
                                 'speechcoursedays' => ['visibility' => 0,'title' => "Sprachkurs",      'type' => 'number'  ],
                                 'workaction_beginn'=> ['visibility' => 1,'title' => "Beginnt",         'type' => 'date'    ],
                                 'workaction_end'   => ['visibility' => 1,'title' => "Endet",           'type' => 'date'    ],
                                 'timeaddon_end'    => ['visibility' => 1,'title' => "Verlängerung",    'type' => 'date'    ],
                                 'created'          => ['visibility' => 0,'title' => "Erstellt",        'type' => 'date'    ],
                                 'creator_id'       => ['visibility' => 0,'title' => "Ersteller",       'type' => ''        ],
                                 'birthday'         => ['visibility' => 1,'title' => "Geb.Datum",       'type' => 'date'    ],
                                 'jobcenterid'      => ['visibility' => 1,'title' => "Jobcenter#",      'type' => 'date'    ],
                                 'handicaped'       => ['visibility' => 0,'title' => "Schwerbehindert", 'type' => 'bool'    ],
                                 'pillflat'         => ['visibility' => 0,'title' => "Krankenkasse",    'type' => 'text'    ],
                                 'bank_id'          => ['visibility' => 0,'title' => "Bank",            'type' => 'text'    ],
                                 'bic'              => ['visibility' => 0,'title' => "BIC",             'type' => 'text'    ],
                                 'iban'             => ['visibility' => 0,'title' => "IBAN",            'type' => 'text'    ],
                                 'accountowner'     => ['visibility' => 0,'title' => "Kto.Inhaber",     'type' => 'text'    ],
                                 'nationality_id'   => ['visibility' => 0,'title' => "Nationalität",    'type' => 'number'  ],
                                 'anrede_id'        => ['visibility' => 0,'title' => "Anrede",          'type' => 'number'  ]];
    
    private $actions        = [ 'ListView' => ['edit','del'],
                                'EditView' => []];
    
    private $views          = ['ListView','EditView'];
    
    private $params         = ['ListView' => ['page','offset','orderby'],
                               'EditView' => ['id']];
    
    private $default_values = ['ListView' => ['page'   => 1,
                                              'offset' => 5,
                                              'orderby'=> 'username'],
        
                               'EditView' => ['id'     => null]];
    
    
    public function __construct($sessionController) {
        $this->setViews($this->views);
        $this->setActions($this->actions);
        $this->setParams($this->params);
        $this->setDefaultValues($this->default_values);
        $this->controller = new EmployeesController($sessionController);
        
        parent::__construct($this->controller);
    }

    public function ListView() {
        $offset=$this->getValues()['offset'];
        $page=$this->getValues()['page'];
        $orderby=$this->getValues()['orderby'];
        $userTable = new EmployeesTable();
        //$listView = new ListView($this->fieldVisibility,$this->fieldTitles);
        $listView = new ListView($this->fields);
            $listView->setModule($this->controller->getCurrentModule());
            $listView->setOrderBy($orderby);
            $listView->setOffset($offset);
            $listView->setPage($page);
            $listView->setTable($userTable);
            $listView->initContent();
        $listView->show();
    }
    public function editView() {
        $id = $this->getValues()['id'];
        $editView = new EditView($this->fields);
        $editView->setId($id);
        
        
        $editView->show();
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