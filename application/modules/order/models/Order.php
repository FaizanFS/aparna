<?php

class Order_Model_Order
{
    /**
     * Variable Declarations
     */
    protected $id;
    protected $buyerName;
    protected $buyerAddress;

    /**
     * Order_Model_Order constructor.
     * @param array|null $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    /**
     * @param $name
     * @param $value
     * @throws Exception
     */
    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }

    /**
     * @param $name
     * @return mixed
     * @throws Exception
     */
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }

    /**
     * @param array $options
     * @return Order_Model_Order
     */
    public function setOptions(array $options): Order_Model_Order
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

    /**
     * @param $id
     * @return Order_Model_Order
     */
    public function setId($id): Order_Model_Order
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param $buyerName
     * @return Order_Model_Order
     */
    public function setBuyerName($buyerName): Order_Model_Order
    {
        $this->buyerName = (string)$buyerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyerName(): string
    {
        return $this->buyerName;
    }

    /**
     * @param $buyerAddress
     * @return Order_Model_Order
     */
    public function setBuyerAddress($buyerAddress): Order_Model_Order
    {
        $this->buyerAddress = (string)$buyerAddress;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyerAddress(): string
    {
        return $this->buyerAddress;
    }
}
