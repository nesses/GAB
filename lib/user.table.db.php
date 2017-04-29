<?php
require_once 'lib/table.db.php';
class UserTable extends DbTable {
	
    private $userID;
	
    private $table = "employee";
	
    private $colNames   = ARRAY("id",
                                "username",
                                "password",
                                "name",
                                "surname",
                                "rights_id",
                                "group_id",
                                "creator_id",
                                "created",
                                "alterer_id",
                                "status"
                                );
    
    private $colTitles  = ARRAY('id'         => 'ID',
                                'username'   => 'Ben.Name',
                                'password'   => 'Passwort',
                                'name'       => 'Vorname',
                                'surname'    => 'Nachname',
                                'group_id'   => 'Gewerk',
                                'rights_id'  => 'Rechte',
                                'creator_id' => 'Ersteller',
                                'created'    => 'Erstellt am',
                                'alterer_id' => 'Bearbeiter',
                                'status'     => 'Status');
    
    private $colTypes =   [ 'id'            =>  'int',
                            'username'      =>  'text',
                            'password'      =>  'password',
                            'name'          =>  'text',
                            'surname'       =>  'text',
                            'group_id'      =>  'combobox',
                            'rights_id'     =>  'combobox',
                            'creator_id'    =>  'int',
                            'created'       =>  'timestamp',
                            'alterer_id'    =>  'int',
                            'status'        =>  'int'];
    
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
    public function getColTypes() {
        return $this->colTypes;
    }
    

    
}
?>

