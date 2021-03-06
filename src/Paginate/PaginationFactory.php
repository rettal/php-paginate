<?php

namespace Paginate;

class PaginationFactory {

    public function __construct() {

    }

    public function getPagination($name, array $config = array()) {
        $class = "\Paginate\\{$name}";
        $pagination = new $class($config);
        return $pagination;
    }
}