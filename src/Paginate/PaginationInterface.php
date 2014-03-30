<?php

namespace Paginate;

interface PaginationInterface {
    public function getRecordsPerPage();
    public function getParams();
    public function getParamKey();
    public function getCurrentPage();
    public function getTargetPath();
    public function getTotalPageCount();
    public function getNextLinkTxt();
    public function getPrevLinkTxt();
    public function getCSSClasses();
    public function getNumPagingLinksToShow();
    public function getItemsTotal();
    public function isValid();
}