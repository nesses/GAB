<?php

/* 
 * @author Matthias Grotjohann
 */
require_once 'inc/conf.inc.php';
class Db {
    private $pdo;
    
    private $rowCount;
    
    private $queryResult;
    /***
    * Creates PDO Connection either to MySQL Server or
    * to an sqlite comatible file dependig on conf.inc.php
    * file
    */
    public function __construct() {
        global $db_type;
        global $db_conf;
	      if($db_type == 'MySQL') {
            $mysql_conf  = $db_conf['MySQL'];
            $this->pdo = new PDO('mysql:host='.$mysql_conf['host'].';dbname='.$mysql_conf['dbname'], $mysql_conf['user'], $mysql_conf['passwd']);
            $this->query("SET NAMES UTF8;");
	      } elseif($db_type == 'SQLite') {
            //create sqlite
	   }
        
    }
	/***
	  * Query database connection
	  * @param string $sql
	  * @throws Excpetion
	*/
    public function query($sql) {
        
        $result = $this->pdo->query($sql);
        if($result) {
            if($result->rowCount() >= 0) {
                $this->rowCount = $result->rowCount();
                $this->queryResult = $result;
                return $result;
            }
        } else {
            throw new Exception("SQL FAILED::".$sql);
        }
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
    
    private function generateInsertList($data) {
        $ret = "'";
        if (is_array($data)) {
            $ret .= implode("', '", $data);
            $ret .= "'";
            return $ret;
        } else {
            throw new Exception(__FUNCTION__.' :: $data :: Not an ARRAY');
        }
    }
    private function sqlFormatData($dataKeyVal) {
        $sql = "";
        foreach ($dataKeyVal as $key => $value) {
            $key = "$key";
            $value = "$value";
            if ($value == null) {
                $sql .= "$key = null, ";
            } else {
                $sql .= "$key = '$value', ";
            }
        }
        
        $sql = rtrim($sql, ", ");
        
        return $sql;
    }
    private function compileWhere($where) {
        if(is_array($where)) {
            $ret = $where[0]." = '".$where[1]."'";
        } else {
            $ret = $where;
        }
        return $ret;
    }
    public function select($tablename,$columns = '*',$where = '',$orderby = '',$limit = '') {
        $columnList = $this->generateColumnList($columns);
        $sql = "SELECT ".$columnList." FROM ".$tablename;
        
        if($where <> '')
            $sql .= " WHERE ".$this->compileWhere($where);
        
        if($orderby <> '')
            $sql .= " ORDER BY $orderby";
        
        if($limit <> '')
            $sql .= " LIMIT $limit";
        
        $sql .= ";";
        echo $sql."<br>";
        $this->query($sql);
        if($this->rowCount > 0) {
            $ret = $this->queryResult->fetchAll();
            return $ret;
        }
        //echo $sql.'<br>';
       
        return null;
    }
    public function update($tablename,$data,$where) {
        $sql = "UPDATE $tablename SET ";
        
        $sql .= $this->sqlFormatData($data)." ";
        
        $sql .= "WHERE ". $this->compileWhere($where)." ";
        
        $sql .= ";";
        
        $this->query($sql);
        
    }
    public function insert($tablename,$data) {
	
        $colNames = $this->generateColumnList(array_keys($data));
        $dataList     = $this->generateInsertList($data);

        $sql = "INSERT INTO $tablename ";
        
        $sql .= "($colNames) VALUES (";
        
        $sql .= "$dataList";
        
        $sql .= ");";
        
        $this->query($sql);
    }
}