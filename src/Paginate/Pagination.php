<?php

namespace Paginate;

/**
 * Pagination
 *
 * Supplies an API for setting pagination details, and renders the resulting
 * pagination markup (html) through the included render.inc.php file.
 *
 * @example
 * <code>
 *     require_once 'Pagination.php';
 *     $page = isset($_GET['page']) ? ((int) $_GET['page']) : 1;
 *     $pagination = new Pagination();
 *     $pagination->setCurrent($page);
 *     $pagination->setTotal(200);
 *     // get markup
 *     $markup = $pagination->parse();
 * </code>
 */
class Pagination implements PaginationInterface {
    
    /**
     * Sets default variables for the rendering of the pagination markup.
     *
     * @var    array
     * @access protected
     */
    protected $variables = array(
        'classes' => array('clearfix', 'pagination'),
        'numPagingLinksToShow' => 10,
        'recordsPerPage' => 20,
        'targetPath' => '',
        'nextLinkTxt' => 'Next &raquo;',
        'prevLinkTxt' => '&laquo; Previous',
        'currentPage' => 1,
        'itemsTotal' => 0,
        'params' => null,
        'key' => 'page'
    );

    /**
     * construct
     *
     * @param array $config Pagination settings
     */
    public function __construct(array $config = array()) {
        $this->setConfig($config);
        
        // defaults
        if(!isset($config['params']) || empty($config['params'])) {
            $this->variables['params'] = $_GET;
        }
        if(!isset($config['key']) || empty($config['key'])) {
            $this->variables['key'] = 'page';
        }
    }
    
    public function setConfig(array $config = array()) {
        if(count($config) > 0) {
            foreach($config as $name=>$value) {
                if(isset($this->variables[$name])) {
                    $this->variables[$name] = $value;            
                }
            }
        }
    }

    /**
     * getRecordsPerPage
     *
     * Gets the number of records per page
     *
     * @access public
     * @return int
     */
    public function getRecordsPerPage() {
        return $this->variables['recordsPerPage'];
    }
    public function getParams() {
        return $this->variables['params'];
    }
    public function getCurrentPage() {
        return $this->variables['currentPage'];
    }
    public function getTargetPath() {
        return $this->variables['targetPath'];
    }
    public function getPrevLinkTxt() {
        return $this->variables['prevLinkTxt'];
    }
    public function getNextLinkTxt() {
        return $this->variables['nextLinkTxt'];
    }
    public function getTotalPageCount() {
        return ((int) ceil($this->variables['itemsTotal'] / $this->variables['recordsPerPage']));
    }
    public function getParamKey() {
        return $this->variables['key'];
    }
    public function getNumPagingLinksToShow() {
        return $this->variables['numPagingLinksToShow'];
    }
    public function getItemsTotal() {
        return $this->variables['itemsTotal'];
    }
    public function getCSSClasses() {
        return $this->variables['classes'];
    }
    public function getCanonicalUrl()
    {
        $target = $this->variables['targetPath'];
        if (empty($target)) {
            $target = $_SERVER['PHP_SELF'];
        }
        $page = (int) $this->variables['currentPage'];
        if ($page !== 1) {
            return 'http://' . ($_SERVER['HTTP_HOST']) . ($target) . $this->getPageParam();
        }
        return 'http://' . ($_SERVER['HTTP_HOST']) . ($target);
    }
    /**
     * isValid
     * 
     * Checks the current (page) and total (records) parameters to ensure
     * they've been set. Throws an exception otherwise.
     *
     * @return bool True if valid, False otherwise
     * @throws \Exception
     */
    public function isValid() {
        
        if (!isset($this->variables['currentPage'])) {
            throw new Exception('Pagination::current must be set.');
        } elseif (!isset($this->variables['itemsTotal'])) {
            throw new Exception('Pagination::total must be set.');
        }
    
        // if it's an invalid page request
        if ($this->variables['currentPage'] < 1 || $this->variables['currentPage'] > $this->getTotalPageCount()) {
            return false;
        }else {
            return true;
        }
        
    }

    public function getConfig() {
        return $this->variables;
    }
    
}