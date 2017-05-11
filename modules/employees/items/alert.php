<$php
class Alert extends Smarty {
    
    private $type;
    
    private $message;
    
    public function __construct() {
        parent::__construct():
    }
    public function setType($type) {
        $this->type = $type;
    }
    public function setMessage($msg) {
        $this->message = $msg;
    }
    public function show() {
        
        $this->assign('type',$this->type);
        $this->assign('message',$this->message);
        $this->display('templates/items/bs_alert.tpl');
        
    }
}a