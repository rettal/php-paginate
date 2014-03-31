<?php
ini_set('display_errors', 1);

require_once('vendor/autoload.php');

// config + model
$config = array(
    'classes' => array('clearfix', 'pagination'),
    'numPagingLinksToShow' => 10,
    'recordsPerPage' => 20,
    'targetPath' => '',
    'nextLinkTxt' => 'Next &raquo;',
    'prevLinkTxt' => '&laquo; Previous',
    'currentPage' => isset($_GET['page']) ? ((int) $_GET['page']) : 1,
    'itemsTotal' => 500,
    'key' => 'page'
);
$pagerClassName = 'Pagination';
$pagerConfig = array('name' => $pagerClassName, 'config' => $config);

// view 1
$pagerViewClassName = 'Numbered';
$pagerViewConfig = array('name' => $pagerViewClassName, 'options' => array('showNextAndPrevLinks' => true));

// view 2
//$pagerViewClassName = 'NextAndPrev';
//$pagerViewConfig = array('name' => $pagerViewClassName);

// init
$ps = new \Paginate\PaginationService();
try {
    $ps->initPagination($pagerViewConfig, $pagerConfig);
}catch(Exception $e) {
    echo $e->getMessage();
    exit;
}

// output; in this case html
echo $ps->getPaginationView()->getOutput();