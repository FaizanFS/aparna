<?php

class AuthenticationController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function loginAction()
    {
      
        if(Zend_Auth::getInstance()->hasIdentity()) {
            $this->_redirect('book/list');
        }
        $form = new Form_LoginForm();
        $request = $this->getRequest();
        if($request->isPost()) {
            if($form->isValid($this->_request->getPost())) {
                $authAdapter = $this->getAuthAdapter();
                $name = $form->getValue('name');
                $password = $form->getValue('password');

                $authAdapter->setIdentity($name)
                            ->setCredential($password);
                $auth = Zend_Auth::getInstance();
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()) {
                    echo "Valid";
                    $identity = $authAdapter->getResultRowObject();
                    $authStorage = $auth->getStorage();
                    $authStorage->write($identity);
                    $this->_redirect('book/list');
                }
                else {
                   $this->view->errorMessage = 'UserName or Passsword is Invalid';
                }
            }
        }
    $this->view->form = $form;
    }

    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_redirect('authentication/login');
    }
    
    private function getAuthAdapter()
    {
        $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $authAdapter->setTableName('users')
                    ->setIdentityColumn('name')
                    ->setCredentialColumn('password');
        return $authAdapter;
    }


}





