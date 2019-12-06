<?php
class Application_Model_LibraryAcl extends Zend_Acl
{
    public function __construct()
    {
        $this->add(new Zend_Acl_Resource('authentication'));
        $this->add(new Zend_Acl_Resource('login'),'authentication');
        $this->add(new Zend_Acl_Resource('logout'),'authentication');

        $this->add(new Zend_Acl_Resource('guestbook'));
        $this->add(new Zend_Acl_Resource('sign'),'guestbook');
        $this->add(new Zend_Acl_Resource('index'),'guestbook');

        $this->add(new Zend_Acl_Resource('book'));
        $this->add(new Zend_Acl_Resource('list'),'book');
        $this->add(new Zend_Acl_Resource('add'),'book');
        $this->add(new Zend_Acl_Resource('edit'),'book');
        $this->add(new Zend_Acl_Resource('delete'),'book');

        $this->addRole(new Zend_Acl_Role('user'));
        $this->addRole(new Zend_Acl_Role('admin'),'user');
        
        $this->allow('user',array('list','authentication'));
        $this->allow('admin',array('book','guestbook'));

    }
}