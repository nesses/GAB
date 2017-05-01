<?php

class GroupsTable {
    private $db;
    private $table = 'groups';
    private $colNames = ARRAY(   'id',
                                 'title',
                                 'description');
	
    public function __construct() {
        $this->db = new DbTable($this->table,$this->colNames);
    }
    public function getAll() {
        $this->db->initTable();
        $tdata = $this->db->asArray();
        return $tdata;
    }

}

?>