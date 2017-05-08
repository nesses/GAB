<?php
/*
 * @author Matthias Grotjohann
 */
require_once 'lib/db.php';
class DbTable {

    private $db;
    
    private $tableName;
    private $colNames = ARRAY();
	
    private $data = ARRAY();
	
    public function __construct($tableName,$colNames) {
        if($tableName && $tableName != "" && $colNames && $colNames != "") {
            $this->db = new Db();
            $this->tableName = $tableName;
            $this->colNames = $colNames;
            
   
        } else throw new Exception(__FUNCTION__." :: Missing Table or Column definitions");
    }
    private function checkData($data) {
        $dataColumns = array_keys($data);
        foreach($dataColumns as $colname => $val) {
            if(!in_array($val, $this->colNames)) {
                return false;
            }
        }
        return true;
    }
    public function initTable($columns = '*',$where = '',$orderby = '',$limit = '') {
        if($columns == '*')
            $columns = $this->colNames;
        
        $tdata = $this->db->select($this->tableName,$columns,$where,$orderby,$limit);
        if($tdata != null) {
            $this->data = $tdata;
            return 1;
        }
        $this->data = null;
        return 0;
    }
    public function query($sql) {
        //echo $sql;
        $res = $this->db->query($sql);
        $this->data = $res->fetchAll();
       
    }
    public function updateTable($data,$where) {
        if($this->checkData($data)) {
            $this->db->update($this->tableName, $data, $where);
        } else 
           throw new Exception(__FUNCTION__." :: Column of given Data does not match table def");
    
        
    }
    public function insertRow($data) {
        if($this->checkData($data)) {
            $this->db->insert($this->tableName , $data);
        } else  
            throw new Exception(__FUNCTION__." :: Column of given Data does not match table def");
    
        
    }
    public function asArray() {
        $ret = ARRAY();
        //print_r($this->data);
        if($this->data) {
            foreach($this->data as $row => $columns) {
                $ret[$row] =ARRAY();
                foreach($columns as $title => $value) {
                    
                        if($title != "0")				
                        $ret[$row]["$title"] = $value;
                    
                }
            }
        }
        return $ret;
    }
}






?>