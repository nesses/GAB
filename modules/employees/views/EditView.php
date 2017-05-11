<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'lib/table.db.php';

class EditView extends Smarty {
    
    private $table;
    private $relatedTables;
    private $relations;
    private $fieldTitles;
    private $fieldTypes;
    
    private $id;
    
    public function __construct($fields) {
        
        foreach($fields as $fieldTitle => $settings) {
            $this->fieldTypes[$fieldTitle] = $settings['type'];
            $this->fieldTitles[$fieldTitle] = $settings['title'];
            
        }
        $this->extractRelatedTables();
        $this->loadRelations();
        
        parent::__construct();
    }
    private function extractRelatedTables($fieldTypes = null) {
        if(!$fieldTypes)
            $fieldTypes = $this->fieldTypes;
        foreach($fieldTypes as $fieldTitle => $settings) {
            if(is_array($settings))
                $this->relations[$fieldTitle] = $settings;
            
        }
        //print_r($this->relations);
    }
    private function loadRelations() {
        foreach($this->relations as $fieldTitle => $table_col) {
            foreach ($table_col as $tableName => $columns) {
                $table = new DbTable($tableName, ['id',$columns]);           
                $table->initTable('id,'.$columns.' as title ');
                $cont = $table->asRaw();
                $this->relatedTables[$fieldTitle] = $cont;  
            }    
        }
        //  print_r($this->relatedTables);
    }
    public function setupColumns($cols) {
        $this->fieldTitles= array_chunk($this->fieldTitles,$cols,true);
    }
    public function initContent() {
        // TODO
        if($this->id > 0) {
            
        } //else we're in create mode 
    }
    public function setTable($table) {
        $this->table = $table;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    public function show() {
        $this->assign("id",$this->id);
        $this->setupColumns(8);
        $this->assign('fieldTitles',$this->fieldTitles);
        //print_r(array_chunk($this->fieldTitles,3,true));
        $this->assign('fieldTypes', $this->fieldTypes);
        $this->assign('relatedTables',$this->relatedTables);
        $this->display("templates/items/EditView.tpl");
    }
}