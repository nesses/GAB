<?php

/* 
 * 
 */
class ListView extends Smarty {
    
    private $fieldVisibility
    private $fieldTitles
    
    private $offset;
    private $page;
    private $pageCount;
    
    
    private $content;
    
    
    
    public function __construct($fieldVisibility,$fieldTitles) {
        $this->fieldVisibility = $fieldVisibility;
        $this->fieldTitles = $fieldTitles;
        parent::__construct();
    }
    
    public function setOffset($offset) {
        $this->offset = $offset;
    }
    
    public function setPage($page) {
        $this->page = $page;
    }
    public function setPageCount($pageCount) {
        $this->pageCount = $pageaCount;
    }
    public function setOrderBy($orderby) {
        $this->orderby = $orderby;
    
    public function setContent($content) {
        $this->content = $content;
    }
    public function show() {
        $this->assign('fieldVisibility',$this->fieldVisibility);
        $this->assign('fieldTitles', $this->fieldTitles);
   
        $this->display('templates/items/ListView.tpl')
    }
}