<?php
class Application_Service_BookService
{
    /**
     * Service function to add books to Library Database
     *
     * @return void
     */
    public function addService($formvalues)
    {
        $book = new Application_Model_Book($formvalues);
        $mapper  = new Application_Model_BookMapper();
        $mapper->save($book);           
    }

    /**
     * Service function to find book details from Library Database
     *
     * @return void
     */
    public function findBookService($request, $id)
    {
        $book = new Application_Model_Book();
        $mapper = new Application_Model_BookMapper();
        $book = $mapper->find($id,$book);
        $data = array(
            'id' => $book->id,
            'bookName' => $book->bookname,
            'author' => $book->author,
            'year' => $book->year,
            'description' =>$book->description
        );

        return $data;
    }

    /**
     * Service function to update book details to Library Database
     *
     * @return void
     */
    public function editService($formvalues)
    {
        $book = new Application_Model_Book($formvalues);
        $mapper  = new Application_Model_BookMapper();
        $mapper->save($book);
    }

     /**
     * Service function to delete books from Library Database
     *
     * @return void
     */
    public function deleteService($request , $id)
    {
        $book = new Application_Model_Book();
        $mapper = new Application_Model_BookMapper();
        $mapper->delete($id,$book);
    }

    /**
     * Service function to list all book details from Library Database
     *
     * @return void
     */
    public function listService()
    {
       $book = new Application_Model_BookMapper();
       $books = $book->fetchAll();
       
       return $books;
    }
}