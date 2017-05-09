<?php

/* 
 * @author Matthias Grotjohann
 */
class EditView extends Smarty {
    
    
    public function __construct() {
        parent::__construct();
    }
    
    public function show() {
        $this->display("templates/items/EditView.tpl");
    }
}

