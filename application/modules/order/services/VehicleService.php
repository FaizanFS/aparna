<?php
class Order_Service_VehicleService
{
    /**
     * Service function order vehicles
     *
     * @return void
     */
    public function addService($formvalues)
    {
        $purchase = new Order_Model_Order($formvalues);
        $mapper  = new Order_Model_OrderMapper();
        $mapper->save($purchase);
    }
}
