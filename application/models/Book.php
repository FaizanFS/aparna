<?php
class Application_Model_Book
{
   
    protected $id;
    protected $bookName;
    protected $author;
    protected $year;
    protected $fileLocation;
    protected $description;
 
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
            throw new Exception('Invalid guestbook property');
        }
        $this->$method($value);
    }
 
    public function __get($name)
    {
        $method = 'get' . ucfirst($name);
        if (!method_exists($this, $method)) {
            throw new Exception('Invalid guestbook property');
        }
        return $this->$method();
    }
 
    public function setOptions(array $options)
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

    public function setId($id)
    {
        $this->id = (int) $id;
        return $this;
    }
 
    public function getId()
    {
        return $this->id;
    }

    public function setBookName($bookName)
    {
        $this->bookName = (string) $bookName;
        return $this;
    }
 
    public function getBookName()
    {
        return $this->bookName;
    }
 
    public function setAuthor($author)
    {
        $this->author = (string) $author;
        return $this;
    }
 
    public function getAuthor()
    {
        return $this->author;
    }
 
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }
 
    public function getYear()
    {
        return $this->year;
    }

    public function setFileLocation($fileLocation)
    {
        $this->fileLocation = $fileLocation;
        return $this;
    }
 
    public function getFileLocation()
    {
        return $this->fileLocation;
    }

    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }
 
    public function getDescription()
    {
        return $this->description;
    }
 
   
}