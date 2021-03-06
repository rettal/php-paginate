<?php

namespace Paginate;

class NumberedPaginationView extends NextAndPrevPaginationView {
    
    public function __construct()
    {
        parent::__construct();
    }
    
    protected function getNumberedLinks()
    {
        /**
         * Calculates the number of leading page crumbs based on the minimum and maximum possible leading pages.
         */
        $max = min($this->pagination->getTotalPageCount(), $this->pagination->getNumPagingLinksToShow());
        $limit = ((int) floor($max / 2));
        $leading = $limit;
        for ($x = 0; $x < $limit; ++$x) {
            if ($this->pagination->getCurrentPage() === ($x + 1)) {
                $leading = $x;
                break;
            }
        }
        for ($x = $this->pagination->getTotalPageCount() - $limit; $x < $this->pagination->getTotalPageCount(); ++$x) {
            if ($this->pagination->getCurrentPage() === ($x + 1)) {
                $leading = $max - ($this->pagination->getTotalPageCount() - $x);
                break;
            }
        }

        // calculate trailing crumb count based on inverse of leading
        $trailing = $max - $leading - 1;
        $pageLinks = '';
        
        // generate/render leading crumbs
        for ($x = 0; $x < $leading; ++$x) {
            $pageNum = $this->pagination->getCurrentPage() + $x - $leading;
            $href = $this->getHrefForPageNum($pageNum);
            $pageLinks .= '<li class="number"><a data-pagenumber="'.($pageNum).'" href="'.$href.'">'.($pageNum).'</a></li>';
    }
    
        // print current page
        $pageLinks .= '<li class="number active"><a data-pagenumber="'.($this->pagination->getCurrentPage()).'" href="#">'.($this->pagination->getCurrentPage()).'</a></li>';
        
        // generate/render trailing crumbs
        for ($x = 0; $x < $trailing; ++$x) {
            $pageNum = $this->pagination->getCurrentPage() + $x + 1;
            $href = $this->getHrefForPageNum($pageNum);
            $pageLinks .= '<li class="number"><a data-pagenumber="'.($pageNum).'" href="'.$href.'">'.($pageNum).'</a></li>';
        }
        
        return $pageLinks;
    }
    
    public function getOutput()
    {
        if($this->pagination->isValid()) {
            if(!empty($this->options['showNextAndPrevLinks']) && $this->options['showNextAndPrevLinks']) {
                return '<ul class="'.implode(' ', $this->pagination->getCSSClasses()).'">'.$this->getPreviousLink().$this->getNumberedLinks().$this->getNextLink().'</ul>';
            }else {
                return '<ul class="'.implode(' ', $this->pagination->getCSSClasses()).'">'.$this->getNumberedLinks().'</ul>';
            }
        }else {
            return '';
        }
    }
}