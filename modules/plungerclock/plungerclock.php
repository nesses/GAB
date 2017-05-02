<?php

/*** 
 * @author Matthias Grotjohann
 */
require_once 'modules/module.mother.php';

class plungerclock extends ModuleMother {
    
    private $pclockTable;
    
    public function __construct($view,$action) {
        parent::__construct();
        
        $this->display('templates/modules/plungerclock.tpl');
    }
    
    
}
    