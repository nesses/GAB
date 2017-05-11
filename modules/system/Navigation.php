<$php

class Navigation extends Smarty {
    
    private $items;
    
    private $activeItem;
    
    private $enableLogin = false;
    
    public function __construct() {
        parent::__construct():
    }
    public function setItems($itms) {
        if(is_array($itms))
            $this->items = $itms;
        else throw Exception('$itms has to be array!');
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
    public function show() {
        $this->assign('items',$this->items);
    }
}