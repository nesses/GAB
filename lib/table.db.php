<?php
require_once 'lib/db.php';
class DbTable extends DB {

    private $tableName;
    private $colNames = ARRAY();
	
    private $data = ARRAY();
	
    public function __construct($tableName,$colNames) {
        if($tableName && $tableName != "" && $colNames && $colNames != "") {
            $this->tableName = $tableName;
            $this->colNames = $colNames;
		
            $this->init();
            $this->prepareData();
        } else throw new Exception(__FUNCTION__." :: Missing Table or Column definitions");
    }
    private function prepareData() {
        foreach($this->colNames as $val) {
            $this->data[0][$val] = null;
        }
    }
    public function loadRow($colname,$value,$id=0) {
        
        $row = $this->select($this->tableName,"".$this->generateColumnList($this->colNames)."","$colname = '$value'");
		if($row != null) {
            $this->data[$id] = $row;
            return 1;
        }
        return 0;
    }
    public function loadTable() {
        $tdata = $this->select($this->tableName,"".$this->generateColumnList($this->colNames)."");
        if($tdata != null) {
            $this->data = $tdata;
            return 1;
        }
        return 0;
    }
    public function getRow($id) {
        return $this->data[$id];
    }
    public function getTable() {
        return $this->data;
    }
    public function setRow($rowdata,$id = 0) {
        $this->data[$id] = $rowdata;
    }
    public function getCol($colname,$id = 0) {
        return $this->data[$id][$colname];
    }
    public function setCol($colname,$data,$id = 0) {
        $this->data[$id][$colname] = $data;
    }
    public function storeRow($id = 0) {
        
	$this->update($this->tableName,$id,$this->asArray()[0]);
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