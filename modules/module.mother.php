<?php
require_once 'lib/rights.table.db.php';
class ModuleMother extends Smarty {

    private $rightsTable;

    public function __construct() {
        parent::__construct();
        $this->rightsTable = new RightsTable();
    }
    public function isAuthenticated() {
        if($_SESSION['user']['status'] == 1)
            return 1;
        return 0;
    }
}

?>