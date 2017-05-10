<?php

/* 
 * @author Matthias Grotjohann
 */
class ListView extends Smarty {
    
    private $module;
    
    private $fieldVisibility;
    private $fieldTitles;
    
    private $table;
    
    private $offset;
    
    private $page;
    
    private $index;
    
    private $pageCount;
    
    private $content;
    
    private $orderby;

    public function __construct($fields) {
        foreach($fields as $fieldTitle => $settings) {
            $this->fieldVisibility[$fieldTitle] = $settings['visibility'];
            $this->fieldTitles[$fieldTitle] = $settings['title'];
        }
        //print_r($this->fieldTitles);
        //die;
        //$this->fieldVisibility = $fieldVisibility;
        //$this->fieldTitles = $fieldTitles;
        parent::__construct();
    }
    public function initContent() {
        $this->content = $this->table->getAllJoined("$this->index",$this->offset,$this->orderby);
        //if($this->offset == 0) $this->offset = 5;
        $this->pageCount = ceil($this->table->countAll()/$this->offset);
    }
    public function setTable($table) {
        $this->table = $table;
    }
    public function setModule($module) {
        $this->module = $module;
    }
    public function setOffset($offset) {
        if($offset > 0)
            $this->offset = $offset;
        else $this->offset = 5;
    }
    public function getOffset() {
        return $this->offset;
    }
    public function setPage($page) {
        if($page == 0)
            $page = 1;
        $this->index = ($page-1) * $this->offset;
        $this->page = $page;
 
    }
    public function setOrderBy($orderby) {
        $this->orderby = $orderby;
    }
    
    public function setContent($content) {
        $this->content = $content;
    }
    
    public function show() {
        $this->assign('fieldVisibility',$this->fieldVisibility);
        $this->assign('fieldTitles', $this->fieldTitles);
        $this->assign('module',$this->module);
        $this->assign('content', $this->content);
        $this->assign('pageCount',$this->pageCount);
        $this->assign('page',$this->page);
        $this->assign('offset',$this->offset);
        $this->display('templates/items/ListView.tpl');
    }
}