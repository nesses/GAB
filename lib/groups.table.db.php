<?php

class GroupsTable extends DbTable {
	
    private $table = 'groups';
    private $colNames = ARRAY('id','title','description');
	
    public function __construct() {
        parent::__construct($this->table,$this->colNames);
    }




}

?>