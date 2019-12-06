<?php
class Plugin_AccessCheck extends Zend_Controller_Plugin_Abstract
{
    private $_acl = null;
    private $_auth = null;

    public function __construct(Zend_Auth $auth, Zend_Acl $acl)
    {
        $this->_acl = $acl;
        $this->_auth = $auth;
    }
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {
        $resource = $request->getControllerName();
        $action = $request->getActionName();
       
        $identity = $this->_auth->getStorage()->read();
        $role = ($identity->role)?$identity->role:'user';
        if(!$this->_acl->isAllowed($role,$action)) {
            $request->setControllerName('authentication')
                    ->setActionName('logout');
            echo "NOt Authorised";
        }   

    }
}