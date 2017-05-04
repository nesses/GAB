<?php
/* 
 * @author Matthias Grotjohann
 */
require_once 'SessionController.php';
class EmployeesViewController extends SessionController {
    private $view;
    private $views = ['listView','editView'];
            
    public function __construct($view) {
        
        if(!in_array($view, $this->views))
           die;
        parent::__construct($open_mod=false);
        $this->view = $view;
    }
    public function getView() {
        return $this->view;
    }
}
