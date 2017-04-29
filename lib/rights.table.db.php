<?php
require_once 'lib/table.db.php';
class RightsTable extends DbTable {

    private $table = "rights";
	
    private $colNames   = ARRAY("id" ,"title","description");
  
    public function __construct() {
        parent::__construct($this->table,$this->colNames);
    }
}
?>