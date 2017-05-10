<?php

/* 
 * @author Matthias Grotjohann
 */
class EditView extends Smarty {
    
    private $table;
    
    private $fieldTitles;
    private $fieldTypes;
    
    private $id;
    
    public function __construct($fields) {
        
        foreach($fields as $fieldTitle => $settings) {
            $this->fieldTypes[$fieldTitle] = $settings['type'];
            $this->fieldTitles[$fieldTitle] = $settings['title'];
        }
        
        parent::__construct();
    }
    public function setTable($table) {
        $this->table = $table;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function show() {
        $this->assign("id",$this->id);
        
        $this->assign('fieldTitles',$this->fieldTitles);
        $this->assign('fieldTypes', $this->fieldTypes);
        
        $this->display("templates/items/EditView.tpl");
    }
}

