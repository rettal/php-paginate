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
        $href = $this->pagination->getCanonicalUrl() . '/' . $href;
        return $href;
    }

    protected function getPreviousLink()
    {
        $href = $this->getHrefForPageNum($this->pagination->getCurrentPage() - 1);
        if ($this->pagination->getCurrentPage() === 1) {
            $href = '#';
        }
        $href = $this->pagination->getCanonicalUrl() . '/' . $href;
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