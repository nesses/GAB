<?php
require_once "lib/smarty-3.1.30/libs/Smarty.class.php";
require_once "modules/employees/items/alert.php";
class Navigation extends Smarty {
    
    private $items;
    
    private $activeItem;
    
    private $enableLogin = false;
    
    private $alert;
    
    public function __construct() {
        parent::__construct();
        $this->alert = new Alert();
    }
    public function setItems($itms) {
        if(is_array($itms))
            $this->items = $itms;
        else throw Exception(__FUNCTION__.' :: $itms has to be array!');
    }
    public function setActiveItem($name) {
        $this->activeItem = $name;
    }
    public function enableLogin($enable) {
        if($enable == true)
            $this->enableLogin = true;
        else
            $this->enableLogin = false;
    }
    public function enableAlert($type,$message) {
        $this->alert->setType($type);
        $this->alert->setMessage($message);
        $this->alert->show();
    }
    public function show() {
        $this->assign('items',$this->items);
        $this->assign('activeItem',$this->activeItem);
        $this->assign('login',$this->enableLogin);
        
        $this->display('templates/items/bs_navigation.tpl');
    }
}