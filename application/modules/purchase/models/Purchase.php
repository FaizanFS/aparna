<?php

class Purchase_Model_Purchase
{
    /**
     * Variable Declarations
     */
    protected $id;
    protected $category;
    protected $ownerName;
    protected $yearOfManufacture;
    protected $sideDriven;
    protected $conditionDescription;
    protected $features;
    protected $status;

    /**
     * Purchase_Model_Purchase constructor.
     * @param array|null $options
     */
    public function __construct(array $options = null)
    {
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function __set($name, $value)
    {
        $method = 'set' . ucfirst($name);
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Purchase property');
        }
        $this->$method($value);
    }

    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid Purchase property');
        }
        return $this->$method();
    }

    /***
     * @param array $options
     * @return Purchase_Model_Purchase
     */
    public function setOptions(array $options) : Purchase_Model_Purchase
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
     * @return Purchase_Model_Purchase
     */
    public function setId($id) : Purchase_Model_Purchase
    {
        $this->id = (int)$id;
        return $this;
    }

    /**
     * Return the data as array
     *
     * original function was refactored to work with php >5.4
     *
     * @param bool $includeProtected includes protected vars on true
     * @return array
     */
    public function toArray($includeProtected = false, $useSnakeCaseKeys = false)
    {
        if ($includeProtected == true) {
            return get_object_vars($this);
        }

        // cast object to array
        $self = (array)$this;

        $clean = [];

        // iterate through returned object properties
        // and get rid of properties which starts with zero bit
        // so we will have only public visibility properties
        foreach ($self as $key => $value) {
            echo'<pre>'; print_r($key); exit;
            if (substr($key, 0, 1) == "\0") continue;
            if (false !== $useSnakeCaseKeys) {
                $camelCaseToSeparatorFilter = new Zend_Filter_Word_CamelCaseToUnderscore();
                $key = strtolower($camelCaseToSeparatorFilter->filter($key));
            }
            $clean[$key] = $value;
        }

        return $clean;
    }

    /**
     * @return int
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @param $category
     * @return Purchase_Model_Purchase
     */
    public function setCategory($category) : Purchase_Model_Purchase
    {
        $this->category = (int)$category;
        return $this;
    }

    /**
     * @return int
     */
    public function getCategory() : int
    {
        return $this->category;
    }

    /**
     * @param $ownerName
     * @return Purchase_Model_Purchase
     */
    public function setOwnerName($ownerName) : Purchase_Model_Purchase
    {
        $this->ownerName = (string)$ownerName;
        return $this;
    }

    /**
     * @return string
     */
    public function getOwnerName() : string
    {
        return $this->ownerName;
    }

    /**
     * @param $yearOfManufacture
     * @return Purchase_Model_Purchase
     */
    public function setYearOfManufacture($yearOfManufacture) : Purchase_Model_Purchase
    {
        $this->yearOfManufacture = (int)$yearOfManufacture;
        return $this;
    }

    /**
     * @return int
     */
    public function getYearOfManufacture() : int
    {
        return $this->yearOfManufacture;
    }

    /**
     * @param $sideDriven
     * @return Purchase_Model_Purchase
     */
    public function setSideDriven($sideDriven) : Purchase_Model_Purchase
    {
        $this->sideDriven = (string)$sideDriven;
        return $this;
    }

    /**
     * @return string
     */
    public function getSideDriven() : string
    {
        return $this->sideDriven;
    }

    /**
     * @param $conditionDescription
     * @return Purchase_Model_Purchase
     */
    public function setConditionDescription($conditionDescription) : Purchase_Model_Purchase
    {
        $this->conditionDescription = (string)$conditionDescription;
        return $this;
    }

    /**
     * @return string
     */
    public function getConditionDescription() : string
    {
        return $this->conditionDescription;
    }

    /**
     * @param $features
     * @return Purchase_Model_Purchase
     */
    public function setFeatures($features) : Purchase_Model_Purchase
    {
        $this->features = $features;
        return $this;
    }

    /**
     * @return string
     */
    public function getFeatures() : string
    {
        return $this->features;
    }

    /**
     * @param $status
     * @return Purchase_Model_Purchase
     */
    public function setStatus($status) : Purchase_Model_Purchase
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatus() : int
    {
        return $this->status;
    }
}
