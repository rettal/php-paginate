<?php

namespace Paginate;

class NextAndPrevJsonView extends AbstractPaginationView {
    
    private $data = array();
    
    public function __construct()
    {
        
    }
        
    protected function getNextLink()
    {
        $href = $this->getHrefForPageNum($this->pagination->getCurrentPage() + 1);
        if ($this->pagination->getCurrentPage() === $this->pagination->getTotalPageCount()) {
            $href = '#';
        }
    
        $target = $this->pagination->getTargetPath();
        if (empty($target)) {
            $target = $_SERVER['PHP_SELF'];
        }
        $page = (int) $this->pagination->getCurrentPage();
        if ($page !== 1) {
            $key = $this->pagination->getParamKey();
            $canonical = 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
        }else {
            $canonical = 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
        }
        $canonical = $this->getCanonicalUrl();
        $href = $canonical . '/' . $href;
        return $href;
    }

    protected function getPreviousLink()
    {
        $href = $this->getHrefForPageNum($this->pagination->getCurrentPage() - 1);
        if ($this->pagination->getCurrentPage() === 1) {
            $href = '#';
        }
        $target = $this->pagination->getTargetPath();
        if (empty($target)) {
            $target = $_SERVER['PHP_SELF'];
        }
        $page = (int) $this->pagination->getCurrentPage();
        if ($page !== 1) {
            $key = $this->pagination->getParamKey();
            $canonical = 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
        }else {
            $canonical = 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
        }
        $canonical = $this->getCanonicalUrl();       
        $href = $canonical . '/' . $href;
        return $href;
    }
    
    public function getOutput()
    {
        if($this->pagination->isValid()) {
            $data['next'] = $this->getNextLink();
            $data['prev'] = $this->getPreviousLink();
            return json_encode($data);
        }else {
            return 'Not Valid';
        }
    }
}