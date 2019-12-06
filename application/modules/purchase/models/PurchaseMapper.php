<?php

class Purchase_Model_PurchaseMapper extends Purchase_Model_AbstractMapper
{
    /**
     * @var _dbTable
     */
    protected $_dbTable;

    /**
     * Mapping of fields
     *
     * @see Shared_Model_AbstractMapper::$_map
     * @var array
     */
    protected $_map = [
        'category' => 'vehicle_category',
        'ownerName' => 'vehicle_owner_name',
        'yearOfManufacture' => 'year_of_manufacture',
        'sideDriven' => 'side_driven',
        'conditionDescription' => 'vehicle_description',
        'features' => 'features',
    ];
    /**
     * @param $dbTable
     * @return Purchase_Model_PurchaseMapper
     * @throws Exception
     */
    public function setDbTable($dbTable): Purchase_Model_PurchaseMapper
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    /**
     * @return _dbTable
     * @throws Exception
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Purchase_Model_DbTable_Purchase');
        }
        return $this->_dbTable;
    }

    /**
     * @param Purchase_Model_Purchase $purchase
     * @throws Exception
     */
    public function save(Purchase_Model_Purchase $purchase)
    {
        $data = array(
            'vehicle_category' => $purchase->getCategory(),
            'vehicle_owner_name' => $purchase->getOwnerName(),
            'year_of_manufacture' => $purchase->getYearOfManufacture(),
            'side_driven' => $purchase->getSideDriven(),
            'vehicle_description' => $purchase->getConditionDescription(),
            'features' => $purchase->getFeatures(),
            'status' => 1,
        );
//echo'<pre>'; print_r((array)$purchase); exit;
        $this->getDbTable()->insert($data);
//        $this->getDbTable()->insert($this->mapToDb($purchase->toArray()));
    }

    /**
     * @return array
     * @throws Exception
     */
    public function fetchAll(): array
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries = array();
        foreach ($resultSet as $row) {
            $entry = new Purchase_Model_Purchase();
            $entry->setId($row->purchase_id)
                ->setCategory($row->vehicle_category)
                ->setOwnerName($row->vehicle_owner_name)
                ->setYearOfManufacture($row->year_of_manufacture)
                ->setSideDriven($row->side_driven)
                ->setConditionDescription($row->vehicle_description)
                ->setStatus($row->status)
                ->setFeatures($row->features);
            $entries[] = $entry;
        }
        return $entries;
    }
}
