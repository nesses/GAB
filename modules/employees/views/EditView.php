<?php

/* 
 * @author Matthias Grotjohann
 */
class EditView extends Smarty {
    
    private $table;
    private $relatedTables;
    private $relations
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
    private function extractRelatedTables($fieldTypes = null) {
        if(!$fieldTypes)
            $fieldTypes = $this->fieldTypes;
        foreach($fieldTypes as $fieldTitle => $settings) {
            if(is_array($settings['title']))
        }
    }
    public function initContent() {
        // TODO
        if($this->id > 0) {
            
        } //else we're in create mode 
    }
    public function setTable($table) {
        $this->table = $table;
    }
    public function setRelatedTables($tables_array) {
        $this->relatedTables = $tables_array;
        
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