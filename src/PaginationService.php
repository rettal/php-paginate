<?php

class PaginationService {
    
    protected $pagerView = null;
    
    protected $pager = null;
    
    public function initPagination(array $pagerViewConfig = array(), array $pagerConfig = array()) {
        
        if(!isset($pagerViewConfig['name'])) {
            throw new Exception('View name not set');
        }

        if(!isset($pagerConfig['name'])) {
            throw new Exception('Pager name not set');
        }

        if(!isset($pagerConfig['config'])) {
            throw new Exception('Pager config not set');
        }
    
        if(!isset($pagerViewConfig['options'])) {
            $pagerViewConfig['options'] = array();
        }        
    
        $viewFactory = new PaginationViewFactory();
        $pagerFactory = new PaginationFactory();
        
        // get pager view object
        $this->pagerView = $viewFactory->getView($pagerViewConfig['name'], $pagerViewConfig['options']);
        
        // get pager object
        $this->pager = $pagerFactory->getPagination($pagerConfig['name'], $pagerConfig['config']);
        
        // set the model on the view
        $this->pagerView->setPagination($this->pager);
    }

    public function getPaginationView() {
        return $this->pagerView;
    }
}
