<?php

namespace Paginate;

class NextAndPrevPaginationView extends AbstractPaginationView {
    
    public function __construct() {
    }
        
    protected function getNextLink() {
        
        // anchor classes and target
        $classes = array('copy', 'next');

        $href = $this->getHrefForPageNum($this->pagination->getCurrentPage() + 1);
        if ($this->pagination->getCurrentPage() === $this->pagination->getTotalPageCount()) {
            $href = '#';
            array_push($classes, 'disabled');
        }

        return '<li class="'.implode(' ', $classes).'"><a href="'.$href.'">'.$this->pagination->getNextLinkTxt() .'</a></li>';
    }

    protected function getPreviousLink() {

        // anchor classes and target
        $classes = array('copy', 'previous');
        
        $href = $this->getHrefForPageNum($this->pagination->getCurrentPage() - 1);
        if ($this->pagination->getCurrentPage() === 1) {
            $href = '#';
            array_push($classes, 'disabled');
        }

        return '<li class="'.implode(' ', $classes).'"><a href="'.$href.'">'.$this->pagination->getPrevLinkTxt() .'</a></li>';
    }
    
    public function getOutput() {
        if($this->pagination->isValid()) {
            return '<ul class="'.implode(' ', $this->pagination->getCSSClasses()).'">'.$this->getPreviousLink().$this->getNextLink().'</ul>';
        }else {
            return '';
        }
    }
}