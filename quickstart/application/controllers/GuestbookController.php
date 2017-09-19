<?php

class GuestbookController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $guestbook = new Application_Model_GuestbookMapper();
        $this->view->entries = $guestbook->fetchAll();
    }
    public function addAction()
    {
        $request = $this->getRequest();

        $request->getParam('id');

        $form    = new Application_Form_Adduser();

        if ($this->getRequest()->isPost()) {
            if ($form->isValid($request->getPost())) {
                $comment = new Application_Model_Guestbook($form->getValues());
                $mapper  = new Application_Model_GuestbookMapper();
                $mapper->save($comment);

                return $this->_helper->redirector('index');
            }
        }

        $this->view->form = $form;
    }
    public function editAction()
    {
        try {
            $request = $this->getRequest();

            $id = $request->getParam('id');

            if($id != 0)
            {
                $story = new Application_Model_DbTable_Guestbook();
                $form    = new Application_Form_Adduser();

                $result = $story->find($request->getParam('id'));
                $form->populate($result->current()->toArray());
            }

            if ($this->getRequest()->isPost()) {
                if ($form->isValid($request->getPost())) {

                    $mapper  = new Application_Model_GuestbookMapper();
                    $updateuser = new Application_Model_Guestbook($form->getValues());

                    $mapper->update($id, $updateuser);

                    return $this->_helper->redirector('index');
                }
            }
            $this->view->form = $form;

        }
        catch (Exception $e) {
            echo $e;
        }
    }
    public function deleteAction()
    {
        try {
            $request = $this->getRequest();
            $id = $request->getParam('id');

            $mapper  = new Application_Model_GuestbookMapper();
            $mapper->delete($id);

            return $this->_helper->redirector('index');
        }
        catch (Exception $e) {
            echo $e;
        }

    }


}