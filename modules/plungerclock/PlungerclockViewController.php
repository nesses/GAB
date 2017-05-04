<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
class PlungerclockViewController extends SessionController {
    private $view;
    private $views = ['dashBoard'];
            
    public function __construct($view) {
        
        if(!in_array($view, $this->views)) {
            echo "NO SUCH VIEW :: $view";
            $_SESSION['view'] = 'dashBoard';
            //die;
            echo '<script type="text/javascript">window.location="index.php?module=plungerclock"</script>';
        
        }
        
        parent::__construct($open_mod=false);
        
        $this->view = $view;
    }
    public function getView() {
        return $this->view;
    }
}
