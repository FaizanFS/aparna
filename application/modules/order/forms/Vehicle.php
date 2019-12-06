<?php

class Order_Form_Vehicle extends Zend_Form
{
    /**
     * Initializing Variables
     */
    protected $_id = null;

    public function init()
    {
        $this->_id = $this->_attribs['id'];
        $this->setMethod(Zend_Form::METHOD_POST)
            ->setName('orderVehicle');
        $id = $this->addElement('hidden', 'id', array('value' => $this->_id));
        $buyerName = $this->addElement('text', 'buyerName', array(
            'label' => 'Vehicle Buyer Name:',
            'required' => true,
            'class' => 'form-control',
            'filters' => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
                ['name' => 'StringToUpper'],
            ],
            'validators' => [
                [
                    'name' => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 15
                    ],
                ],
            ]
        ));
        $buyerAddress = $this->addElement('textarea', 'buyerAddress', array(
            'label' => 'Vehicle Buyer Address',
            'cols' => 50,
            'rows' => 4
        ));
        $this->addElement('submit', 'add', array(
            'ignore' => true,
            'label' => 'Order Vehicle',
            'class' => 'btn btn-primary col-sm-4'
        ));
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . '/order/vehicle/index');
    }
}
