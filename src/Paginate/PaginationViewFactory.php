<?php

namespace Paginate;

class PaginationViewFactory {

    public function __construct()
    {

    }

    public function getView($name, array $options = array())
    {
        $class = "\Paginate\\{$name}View";
        $view = new $class();
        $view->setOptions($options);
        return $view;
    }
}