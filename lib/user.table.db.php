<?php
require_once 'lib/table.db.php';
class UserTable extends DbTable {
	
    private $userID;
	
    private $table = "employee";
	
    private $colNames   = ARRAY("id","username","password","name","surname","rights_id","group_id","creator_id","created", "alterer_id","status");
    private $colTitles  = ARRAY('id'         => 'ID',
                                'username'   => 'Benutzername',
                                'password'   => 'Passwort',
                                'name'       => 'Vorname',
                                'surname'    => 'Nachname',
                                'group_id'   => 'Arbeitsgruppe',
                                'rights_id'  => 'Berechtigung',
                                'creator_id' => 'Ersteller',
                                'created'    => 'Erstellt am',
                                'alterer_id' => 'Geändert von',
                                'status'     => 'Status');
    public function __construct() {
        parent::__construct($this->table,$this->colNames);
    }
    public function setUsername($username) {
        $this->setCol('username', $username);
    }
    public function setPassword($passwd) {
        $this->setCol('password', $passwd);
    }
    public function setStatus($status) {
        $this->setCol('status',$status);
    }
    public function getUsername() {
        return $this->getCol('username');
    }
   public function getMD5Password() {
        return $this->getCol('password');
    }
    public function getStatus() {
        return $this->getCol('status');
    }
    public function getRights() {
        return $this->getCol('rights_id');
    }
    public function getUserID() {
        return $this->getCol('id');
    }	
    public function getColTitles() {
        return $this->colTitles;
    }
    

    
}
?>

