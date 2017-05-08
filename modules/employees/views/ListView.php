<?php

/* 
 * 
 */
class ListView extends Smarty {
    
    private $module;
    private $fieldVisibility;
    private $fieldTitles;
    
    private $offset = 5;
    
    private $page;
    private $pageCount;
    
    private $content;

    public function __construct($fieldVisibility,$fieldTitles) {
        $this->fieldVisibility = $fieldVisibility;
        $this->fieldTitles = $fieldTitles;
        parent::__construct();
    }
    public function setModule($module) {
        $this->module = $module;
    }
    public function setOffset($offset) {
        $this->offset = $offset;
    }
    public function getDefaultOffset() {
        return $this->offset;
    }
    public function setPage($page) {
        $this->page = $page;
    }
    public function setPageCount($pageCount) {
        $this->pageCount = $pageCount;
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