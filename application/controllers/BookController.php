<?php

class BookController extends Zend_Controller_Action
{
    /**
     * Variable Declaration
     *@bookService BookService
     */
    protected $bookService;

    /* Initialize action controller here */
    public function init()
    {
       $this->bookService = new Application_Service_BookService;
    }
    
    /**
     * Controller Function to add Books
     *
     * @return void
     */
    public function addAction()
    {
        $this->view->headTitle('Add Book ','PREPEND');
        $form = new Form_AddBookForm();
        $this->view->form = $form;
        $request = $this->getRequest();
        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $this->bookService->addService($form->getValues());     
                $this->_redirect('book/list');
            }
        }
 
        $this->view->form = $form;
    }

    /**
     * Controller Function to edit Books
     *
     * @return void
     */
    public function editAction()
    {
        $request = $this->getRequest();
        $this->view->headTitle('Edit Book ','PREPEND');
        $id = ($this->_request->getParam('id'))?($this->_request->getParam('id')):$request->id;
        $form = new Form_EditBookForm(); 
        $data = $this->bookService->findBookService($request, $id);    
        $this->view->form = $form->populate($data);
        
        if($request->isPost()) {
            if ($form->isValid($request->getPost())) {
                $this->bookService->editService($form->getValues());     
                $this->_redirect('book/list');
            }
        }
    }

    /**
     * Controller Function to delete Books
     *
     * @return void
     */
    public function deleteAction()
    {
        $request = $this->getRequest();
        $id = $this->_request->getParam('id');
        $this->bookService->deleteService($request , $id);
        $this->_redirect('book/list');

    }

    /**
     * Controller Function to list all Books
     *
     * @return void
     */
    public function listAction()
    {
        $this->view->headTitle('Book Listing ','PREPEND');
        $this->view->books = $this->bookService->listService();
    }


}









