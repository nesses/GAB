<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'ActionController.php';
class PlungerclockActionController extends ActionController {
    private $sessionController;
    
    private $actions = ['stamp'];
    

    private $pclockTable;
    
    public function __construct($sessionController,$pclockTable,$debug) {
        if($debug)
            echo "<br><b>[DBG]PlungerclockActionController</b>";
        $this->sessionController = $sessionController;
        $this->pclockTable = $pclockTable;
        parent::__construct($sessionController,$this->actions);
    
        
    }
    public function stamp() {
        if(isset($_POST['stamp'])) {
            $last_stamp_id = $this->pclockTable->getLastStatusByUserId($_SESSION['user']['id']);
            
            //toggle stamp because you can not come to work twice
            if($last_stamp_id == 0)
                $stamp_id = '1'; 
            elseif($last_stamp_id == 1)
                $stamp_id = '0';
            
            $this->pclockTable->insertStamp($_SESSION['user']['id'],$stamp_id);  
            
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
        }
        
    }
    public function stampforget() {
        echo "STAMPFORGET";
    }
    
}