<?php

/* 
 * @author Matthias Grotjohann
 */
class ViewController {
     
    private $sessionController;
    
    private $error;
    public function __construct($sessionController,$views,$params,$debug=false) {
        $this->sessionController = $sessionController;
        $this->error = $this->sessionController->getError();
        
        if($debug) {
            echo "<br>View :: ".$this->sessionController->getView();
            //die;
        }
        if(!in_array($sessionController->getView(), $views)) {
            if($debug) {
                echo "<br><b>NOT FOUND<b>";
                
            }
            echo '<script type="text/javascript">window.location="index.php?module='.$sessionController->getModule().'&view='.$views[0].'"</script>';
        
        } else {
            $view = $sessionController->getView();
            
            if($sessionController->amIAllowed()) {
                if($params[$view]) {
                    $sessionController->fetchParams($params[$view]);
                }
                try {
                        $this->$view();

                } catch (Throwable $e) {}
            } else echo "VIEW::KEINE"; 
        } 
        
    }
    public function mkInt($dbl) {
        return round($dbl,0);
    }
    public function getError() {
        return $this->error;
    }
    
}
