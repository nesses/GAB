<?php
require_once 'lib/db.php';
class DbTable {

    private $db;
    
    private $tableName;
    private $colNames = ARRAY();
	
    private $data = ARRAY();
	
    public function __construct($tableName,$colNames) {
        if($tableName && $tableName != "" && $colNames && $colNames != "") {
            $db = new Db();
			
            $this->tableName = $tableName;
            $this->colNames = $colNames;
            if($this->testTable() <> 1)
					throw new Exception(__FUNCTION__." :: Column definition does not match");
   
        } else throw new Exception(__FUNCTION__." :: Missing Table or Column definitions");
    }
    private function testTable() {
        $tdata = $this->db->select($this->tableName,$this->colNames,['id','1']);
        if(!$tdata)
             return 0;
		 return 1;
	 }
    public function initTable($columns = '*',$where = '') {
        if($columns == '*')
            $columns = $this->colNames;
        
        $tdata = $this->db->select($this->tableName,$columns,$where);
        if($tdata != null) {
            $this->data = $tdata;
            return 1;
        }
        return 0;
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