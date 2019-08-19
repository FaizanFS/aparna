<?php
class Form_EditBookForm extends Zend_Form
{
    public function init()
    {
        $this->setName('bookAdd');
        $id = $this->createElement('hidden', 'id');
        $this->addElement($id);
        $this->addElement('text', 'bookName', array(
                'label'      => 'Book Name:',
                'required'   => true,
                'class'   => 'form-control',
                'filters' => [],
                'validators' => []
                ));
        $this->addElement('text', 'author', array(
                'label'      => 'Author Name:',
                'required'   => true,
                'class'   => 'form-control',
                'filters' => [],
                'validators' => []

            )); 
        $this->addElement('select', 'year', array(
            'label'      => 'Year of Release:',
            'required'   => true,
            'multiOptions'   => array('2019'=>'2019',
                                      '2018' => '2019',
                                      '2017' => '2017',
                                      '2016' =>'2016'
                                    ),
            'class'   => 'form-control',
            'filters' => [],
            'validators' => []
        ));       
        
        $description = new Zend_Form_Element_Textarea( 'description' );
        $description->setLabel('Description:')
                         ->setAttrib('cols', 50)
                         ->setAttrib('rows', 4)
                         ->addValidator('StringLength', false, array(10, 250))
                         ->setRequired( true )
                         ->setErrorMessages(array('Text must be between 40 and 250 characters'))
                         ->setAttrib('class','form-control');
        $this->addElements(array($year,$description));    
                 
        // $this->addElement('file', 'file', array(
        //                     'label'      => 'Upload Related Snippets (if any)'
        //                 ));
        $this->addElement('submit', 'add', array(
                            'ignore'   => true,
                            'label'    => 'Confirm Update',
                            'class'    =>'btn btn-primary col-sm-4' 
                        ));    
        $this->addElement('hash', 'csrf', array(
                            'ignore' => true,
                        ));                             
        $this->setMethod('post');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl()."/book/edit"); 
    }
}