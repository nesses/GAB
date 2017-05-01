l<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Db {
    private $pdo;
    
    private $rowCount;
    
    private $queryResult;
    
    public function __construct() {
        global $mysql_conf;
        $this->pdo = new PDO('mysql:host='.$mysql_conf['host'].';dbname='.$mysql_conf['dbname'], $mysql_conf['user'], $mysql_conf['passwd']);
        $this->query("SET NAMES UTF8;");
        
    }
    private function query($sql) {
        
        $result = $this->pdo->query($sql);
        $_SESSION['SQL']="$sql";
        if($result) {
            
            if($result->rowCount() > 0) {
                $this->rowCount = $result->rowCount();
                $this->queryResult = $result;
                
            }
            return 1;
        } else {
            $this->rowCount = null;
            $this->queryResult = null;
            
        }
        return 0;
    }
    
    /**
     * generates list of columns from array when given
     * @param  array     $columns     array of columns
     * @return string                  imploded array
     */
    private function generateColumnList($columns) {
        if (is_array($columns)) {
            return implode(', ', $columns);
        } else {
            return $columns;
        }
    }
    private function compileWhere($where) {
        if(is_array($where)) {
            $ret = $where[0]." = '".$where[1]."'";
        } else {
            $ret = $where;
        }
        return $ret;
    }
    public function select($tablename,$columns,$where = '') {
        $columnList = $this->generateColumnList($columns);
        $sql = "SELECT ".$columnList." FROM ".$tablename;
        
        if($where <> '')
            $sql .= " WHERE ".$this->compileWhere($where);
        
        $sql .= ";";
        
        if($this->query($sql) == 1) {
            if($this->rowCount > 0) {
                $ret = $this->queryResult->fetchAll();
                return $ret;
            }
        }
        return null;
    }
}
