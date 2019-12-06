<?php
class Form_LoginForm extends Zend_Form
{
    public function init()
    {
        $this->setName('login');

        $this->addElement('text', 'name', array(
                'label'      => 'User Name:',
                'required'   => true,
                'class'   => 'form-control',
                ));
        $this->addElement('password', 'password', array(
                'label'      => 'Password:',
                'required'   => true,
                'class'   => 'form-control',

            ));    
        $this->addElement('submit', 'login', array(
                'ignore'   => true,
                'label'    => 'Login',
                'class'    =>'btn btn-primary' 
            )); 

        $this->addElements(array($name,$password,$login));    
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl().'/authentication/login');  
    }
}