<?php

class Purchase_Service_VehicleService
{
    /**
     * Service function to add purchased vehicle details
     *
     * @return void
     */
    public function addService($formValues)
    {
        $formValues['features'] = implode(',', $formValues['features']);
        $purchase = new Purchase_Model_Purchase($formValues);
        $mapper = new Purchase_Model_PurchaseMapper();
        $mapper->save($purchase);
    }

    /**
     * Service function to list purchased vehicle details
     * @return array
     */
    public function listService()
    {
        $purchase = new Purchase_Model_PurchaseMapper();
        $vehicles = $purchase->fetchAll();
        return $vehicles;
    }
}