<?php

class Order_Model_OrderMapper
{
    /**
     * Variable Declarations
     */
    protected $_dbTable;

    /**
     * @param $dbTable
     * @return Order_Model_OrderMapper
     * @throws Exception
     */
    public function setDbTable($dbTable): Order_Model_OrderMapper
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
     * @return mixed
     * @throws Exception
     */
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Order_Model_DbTable_Order');
        }
        return $this->_dbTable;
    }

    /**
     * @param Order_Model_Order $order
     * @throws Exception
     */
    public function save(Order_Model_Order $order)
    {
        $data = array(
            'buyer_name' => $order->getBuyerName(),
            'buyer_address' => $order->getBuyerAddress(),
            'purchase_id' => $order->getId()
        );
        $this->getDbTable()->insert($data);
    }
}
