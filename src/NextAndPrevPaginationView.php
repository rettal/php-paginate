<?php

class NextAndPrevPaginationView extends AbstractPaginationView {
    
    public function __construct() {
    }
        
    protected function getNextLink() {
        
        // anchor classes and target
        $classes = array('copy', 'next');
        $params = $this->pagination->getParams();
        $params[$this->pagination->getParamKey()] = ($this->pagination->getCurrentPage() + 1);
        $href = ($this->pagination->getTargetPath()) . '?' . http_build_query($params);
        $href = preg_replace(
            array('/=$/', '/=&/'),
            array('', '&'),
            $href
        );
        if ($this->pagination->getCurrentPage() === $this->pagination->getTotalPageCount()) {
            $href = '#';
            array_push($classes, 'disabled');
        }

        return '<li class="'.implode(' ', $classes).'"><a href="'.$href.'">'.$this->pagination->getNextLinkTxt() .'</a></li>';
    }

    protected function getPreviousLink() {
        /**
         * Previous Link
         */

        // anchor classes and target
        $classes = array('copy', 'previous');
        $params = $this->pagination->getParams();
        $params[$this->pagination->getParamKey()] = ($this->pagination->getCurrentPage() - 1);
        $href = ($this->pagination->getTargetPath()) . '?' . http_build_query($params);
        $href = preg_replace(
            array('/=$/', '/=&/'),
            array('', '&'),
            $href
        );
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