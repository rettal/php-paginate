<?php

namespace Paginate;

abstract class AbstractPaginationView {
    
    protected $pagination;
    
    protected $options = array();
    
    public function setPagination(PaginationInterface $pi = null)
    {
        $this->pagination = $pi;
    }

    public function setOptions(array $opts = array())
    {
        $this->options = $opts;
    }

    protected function getHrefForPageNum($page)
    {
        $params = $this->pagination->getParams();
        $params[$this->pagination->getParamKey()] = ($page);
        $href = ($this->pagination->getTargetPath()) . '?' . http_build_query($params);
        $href = preg_replace(
            array('/=$/', '/=&/'),
            array('', '&'),
            $href
        );
        return $href;
    }

    protected function getCanonicalUrl()
    {
        $target = $this->pagination->getTargetPath();
        if (empty($target)) {
            $target = $_SERVER['PHP_SELF'];
        }
        $canonical = (isset($this->options['canonical']) ? $this->options['canonical'] : '');
        if(empty($canonical)) {
            $canonical = 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
        }else {
            $canonical . ($target);
        }
        return $canonical;
    }

    public abstract function getOutput();    
}