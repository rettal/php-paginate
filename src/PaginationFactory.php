<?php

class PaginationFactory {

    public function __construct() {

    }

    public function getPagination($name, array $config = array()) {
        $class = "{$name}";
        $pagination = new $class($config);
        return $pagination;
    }
}