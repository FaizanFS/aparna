<?php

class Purchase_VehicleController extends Zend_Controller_Action
{
    /**
     * Variable Declaration
     * @var Purchase_Service_VehicleService
     */
    protected $vehicleService;
    /**
     * Class Constants
     */
    const PURCHASE_LISTING_PAGE_URL = 'purchase/vehicle/list';

    /* Initialize action controller here */

    public function init()
    {
        $this->vehicleService = new Purchase_Service_VehicleService();
    }

    /**
     * Index Action of vehicleController that adds the purchase details to Database
     */
    public function indexAction()
    {
        $this->view->headTitle('Purchase Vehicle ', 'PREPEND');
        $form = new Purchase_Form_Vehicle();
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                try {
                    $this->vehicleService->addService($form->getValues());
                    $this->redirect(self::PURCHASE_LISTING_PAGE_URL);
                } catch (Exception $s) {
                    echo "Data Not Saved due to Exception <br>".$s;
                }
            }else {
                echo "The form is not valid\n";
                    print_r($form->getMessages());die;
                }
        }
        $this->view->assign('form', $form);
    }

    /**
     * listAction of vehicleController that lists out all the purchase details
     */
    public function listAction()
    {
        $this->view->headTitle('Vehicle Listing ', 'PREPEND');
        $this->view->vehicles = $this->vehicleService->listService();
    }
}
