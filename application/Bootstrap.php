<?php
error_reporting(E_ALL);
include application/models/LibraryAcl.php;
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAutoload()
    {
        $modelLoader = new Zend_Application_Module_Autoloader(array(
                'namespace' => '',
                'basePath' =>  APPLICATION_PATH
        ));

        $acl = new Application_Model_LibraryAcl();
        $auth = Zend_Auth::getInstance();
        $fc = Zend_Controller_Front::getInstance();
        $fc->registerPlugin(new Plugin_AccessCheck($auth,$acl));
   
        return $modelLoader;    
    }
    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        
        $view->doctype('HTML5');  
        $view->headMeta()->appendHttpEquiv('Content-type','text/html;charset=utf-8')
                         ->appendName('description','Using View Helpers in Zend View');  
        $view->headTitle()->setSeparator(' - '); 
        $view->headTitle('Library Application');
    }

}

