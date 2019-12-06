<?php
class Application_Model_BookMapper
{
    protected $_dbTable;
 
    public function setDbTable($dbTable)
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
 
    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Book');
        }
        return $this->_dbTable;
    }
 
    public function save(Application_Model_Book $book)
    {
        $data = array(
            'bookname'   => $book->getBookName(),
            'author' => $book->getAuthor(),
            'year' => $book->getYear(),
            'filelocation' =>' dummy',
            'description' => $book->getDescription(),
        );

        if (null === ($id = $book->getId())) {
            unset($data['id']);
            $this->getDbTable()->insert($data);
        } else {
            // echo $id = $book->getId();
            $this->getDbTable()->update($data, array('id = ?' => $id));
        }
    }
 
    public function find($id, Application_Model_Book $book)
    {
        $result = $this->getDbTable()->find($id);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $book->setId($row->id)
                  ->setBookName($row->bookname)
                  ->setAuthor($row->author)
                  ->setYear($row->year)
                  ->setFileLocation($row->filelocation)
                  ->setDescription($row->description);
        return $book;
    }
 
    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Book();
            $entry->setId($row->id)
                    ->setBookName($row->bookname)
                    ->setAuthor($row->author)
                    ->setYear($row->year)
                    ->setFileLocation($row->filelocation)
                    ->setDescription($row->description);
            $entries[] = $entry;
        }
        return $entries;
    }
    public function delete($id, Application_Model_Book $book)
    {
        $book = $this->getDbTable()->find($id)->current();
        if($book) {
            $book->delete();
            return true;
        } else {
            throw new Zend_Exception("Delete function failed; could not find row!");
        }
    }
}