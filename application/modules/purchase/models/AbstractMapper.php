<?php
/*
 * Application model 
 * abstract file for all mappers
 */
Abstract class Purchase_Model_AbstractMapper
{
    protected $_map = array();
    /**
     * Maps db field names to domain properties
     *
     * @param array $data
     * @return array The mapped data
     */
    public function mapFromDb(array $data)
    {
        $flippedMap = array_flip($this->_map);
        $data = $this->_doMap($flippedMap, $data);
        return $data;
    }

    /**
     * Maps domain properties to db field names
     *
     * @param array $data
     * @return array The mapped data
     */
    public function mapToDb(array $data)
    {
        return $this->_doMap($this->_map, $data);
    }
    
    /**
     * Maps keynames from an associative array to keynames in the provided map
     * and replaces the keys with the mapped keys. Keys not found in the map
     * are preserved
     *
     * @param array $map
     * @param array $data
     * @return array The mapped data
     */
    protected function _doMap(array $map, array $data)
    {
      print_r($map);print_r($data);die;
        $mappedData = array();
        foreach ($data as $key => $value) {
            // We convert all DateTime objects to the standard MySQL date
            // format.
//            if ($value instanceof DateTime) $value = $value->format('Y-m-d H:i:s');
            if (array_key_exists($key, $map)) {
                $mappedData[$map[$key]] = $value;
            } else {
                $mappedData[$key] = $value;
            }
        }

        return $mappedData;
    }
}