<?php
require_once 'lib/db.php';
class DbTable extends Db {

    private $db;
    
    private $tableName;
    private $colNames = ARRAY();
	
    private $data = ARRAY();
	
    public function __construct($tableName,$colNames) {
        if($tableName && $tableName != "" && $colNames && $colNames != "") {
            parent::__construct();
            $this->tableName = $tableName;
            $this->colNames = $colNames;
            $this->testTable();
            
    } else throw new Exception(__FUNCTION__." :: Missing Table or Column definitions");
    }
    private function testTable() {
        $tdata = $this->select($this->tableName,$this->colNames,['id','1']);
        if(!$tdata)
            throw new Exception(__FUNCTION__." :: Column definition does not match");
    }
    public function initTable($columns = '*') {
        if($columns == '*')
            $columns = $this->colNames;
        
        $tdata = $this->select($this->tableName,$columns);
        if($tdata != null) {
            $this->data = $tdata;
            return 1;
        }
        return 0;
    }
    public function initRow() {
        
    }
    public function asArray() {
        $ret = ARRAY();
        
        foreach($this->data as $row => $columns) {
            $ret[$row] =ARRAY();
            foreach($columns as $title => $value) {
                if(in_array($title,$this->colNames) ) {
                    if($title != "0")				
                    $ret[$row]["$title"] = $value;
                }
            }
		}
        return $ret;
    }
}






?>