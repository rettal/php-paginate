<?php

namespace Paginate;

abstract class AbstractPaginationView {
    
    protected $pagination;
    
    protected $options = array();
    
    public function setPagination(PaginationInterface $pi = null) {
        $this->pagination = $pi;
    }

    public function setOptions(array $opts = array()) {
        $this->options = $opts;
    }


    public abstract function getOutput();
    
}