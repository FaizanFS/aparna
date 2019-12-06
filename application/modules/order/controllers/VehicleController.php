<?php

class Order_VehicleController extends Zend_Controller_Action
{
    /**
     * Variable Declaration
     * @vehicleService VehicleService
     */
    protected $vehicleService;

    /**
     * Class Constants
     */
    const PURCHASE_LISTING_PAGE_URL = 'purchase/vehicle/list';

    /* Initialize action controller here */
    public function init()
    {
        $this->vehicleService = new Order_Service_VehicleService();
    }

    /**
     * Index Action of vehicleController that adds the purchase details to Database
     */
    public function indexAction()
    {
        $this->view->headTitle('Order Vehicle ', 'PREPEND');
        $request = $this->getRequest();
        $id = ($this->_request->getParam('id')) ? ($this->_request->getParam('id')) : $request->id;
        $form = new Order_Form_Vehicle(array('id' => $id));
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                try {
                    $this->vehicleService->addService($form->getValues());
                    $purchaseStatusUpdate = new Purchase_Model_DbTable_Purchase();
                    $where = $purchaseStatusUpdate->getAdapter()->quoteInto('purchase_id = ?', $id);
                    $purchaseStatusUpdate->update(array('status' => 0),$where);
                   $this->_redirect(self::PURCHASE_LISTING_PAGE_URL);
                } catch (Exception $s) {
                    echo "Data Not Saved due to Exception <br>".$s;
                }
            }
        }
        $this->view->form = $form;
    }
}
