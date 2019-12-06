<?php

class Purchase_Form_Vehicle extends Zend_Form
{
    public function init()
    {
        $this->setMethod(Zend_Form::METHOD_POST)
            ->setName('purchaseVehicle');
        $this->setAction(Zend_Controller_Front::getInstance()->getBaseUrl() . '/purchase/vehicle/index');
        $this->addElement(
            'select',
            'category',
            [
                'label' => 'Vehicle Category:',
                'required' => true,
                'multiOptions' => array(
                    '3' => 'Truck',
                    '6' => 'Trekker',
                    '7' => 'Semi Trailer',
                ),
                'class' => 'form-control',
                'filters' => [],
                'validators' => [],
            ]
        );
        $this->addElement('text', 'ownerName', array(
            'label' => 'Vehicle Owner Name:',
            'required' => true,
            'class' => 'float:right form-control col-md-6',
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
        $this->getElement('ownerName')
            ->removeDecorator('li')
            ->removeDecorator('label')
            ->removeDecorator('dt')
            ->removeDecorator('HtmlTag');

        $this->addElement('select', 'yearOfManufacture', array(
            'label' => 'Year of Manufacture:',
            'required' => true,
            'multiOptions' => array(
                '2019' => '2019',
                '2018' => '2018',
                '2017' => '2017',
                '2016' => '2016'
            ),
            'class' => 'form-control',
            'filters' => [],
            'validators' => []
        ));
        $this->addElement('radio', 'sideDriven', array(
            'label' => 'Side Driven',
            'multiOptions' => array(
                'left' => 'Left',
                'right' => 'Right',
            ),
        ));
        $this->addElement('textarea', 'conditionDescription', array(
            'label' => 'Vehicle Condition Description',
            'class' => 'float:right form-control col-md-6',
            'cols' => 50,
            'rows' => 4
        ));
        $this->getElement('conditionDescription')
            ->removeDecorator('li')
            ->removeDecorator('label')
            ->removeDecorator('dt')
            ->removeDecorator('HtmlTag');
        $this->addElement('multiCheckbox', 'features',
            array(
                'label' => 'Features',
                'multiOptions' => array(
                    'airco' => 'Airco',
                    'refrigerator' => 'Refrigerator',
                    'navigation' => 'Navigation',
                    'multiple_beds' => 'Multiple Beds',
                )
            )
        );
        $this->addElement('submit', 'add', array(
            'ignore' => true,
            'label' => 'Add Vehicle',
            'class' => 'btn btn-primary col-sm-4 offset-3'
        ));
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}
