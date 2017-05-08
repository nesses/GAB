<?php

/* 
 * 
 */
class ListView extends Smarty {
    
    private $offset;
    private $index;
    private $orderby;
    
    private $fieldVisibility = ["id"                =>  1,
                                "username"          =>  1,
                                "password"          =>  0,
                                "name"              =>  1,
                                "surname"           =>  1,
                                "lastseen"          =>  1,
                                "rights_id"         =>  1,
                                "groups_id"         =>  1,
                                "creator_id"        =>  1,
                                "created"           =>  0,
                                "alterer_id"        =>  0,
                                "userstatus_id"     =>  1];    
    
    private $fieldTitles =  [   'id'            =>  'ID',
                                'username'      =>  'Benutzername',
                                'password'      =>  'Password',
                                'name'          =>  'Name',
                                'surname'       =>  'Vorname',
                                'lastseen'      =>  'Zuletzt',
                                'groups_id'     =>  'Gewerk',
                                'rights_id'     =>  'Rechte',
                                'creator_id'    =>  'Ersteller',
                                'created'       =>  'Erstellt',
                                'alterer_id'    =>  'Bearbeiter',
                                'userstatus_id' =>  'Status'];
    
    private $table;
    public function __construct($table) {
        parent::__construct();
        $this->assign('fieldVisibility',$this->fieldVisibility);
        $this->assign('fieldTitles', $this->fieldTitles);
        $this->table = $table;
    }
    public function setOffset($offset) {
        $this->offset = $offset;
    }
    public function setIndex($index) {
        $this->index = $index;
    }
    public function setOrderBy($orderby) {
        $this->orderby = $orderby;
    }
}