<?php

class RestuserController extends Zend_Controller_Action
{
    public function indexAction()
    {
        function getListUser($username, $password)
        {
            if($username==1 && $password==1)
            {
                $guestbook = new Application_Model_GuestbookMapper();
                $listUser =new Application_Model_Guestbook();
                //$this->view->entries = $guestbook->fetchAll();
                $listUser = $guestbook->fetchAll();


                $strValue ='';
                foreach ($listUser as $row)
                {
                    $strValue = $strValue.'<value>
                                        <id>'.$row->getUserId().'</id>
                                        <username>'.$row->getUsername().'</username>
                                        <fullname>'.$row->getFullname().'</fullname>
                                        <email>'.$row->getEmail().'</email>
                                        <created>'.$row->getCreated().'</created>
                                    </value>';
                }

                $xml ='<?xml version="1.0" encoding="ISO-8859-1"?>
                   <mysite>'.$strValue.'<code>200</code></mysite>';

                $xml = simplexml_load_string($xml);
                return $xml;
            }
            return false;
        }
        $server = new Zend_Rest_Server();
        $server->addFunction('getListUser');
        $server->handle();
    }
    public function postAction()
    {
        function addUser($username, $password, $id, $namelogin,$fullname,$email,$created)
        {
            $guestbook = new Application_Model_Guestbook();
            $guestbook->setUserId($id)
                         ->setUsername($username)
                         ->setFullname($fullname)
                         ->setEmail($email)
                         ->setCreated($created);

            $mapper  = new Application_Model_GuestbookMapper();
            $mapper->save($guestbook);

            $xml ='<?xml version="1.0" encoding="ISO-8859-1"?>
                   <mysite><infromation>Insert sucessfull</infromation><code>200</code></mysite>';

            $xml = simplexml_load_string($xml);
            return $xml;
        }
        $server = new Zend_Rest_Server();
        $server->addFunction('addUser');
        $server->handle();
    }

    public function getAction()
    {
        function getUserByID($username, $password, $id)
        {
            if($id != 0)
            {
                $story = new Application_Model_DbTable_Guestbook();
                $result = $story->find($id);
                if($result !=null)
                {
                    $xml ='<?xml version="1.0" encoding="ISO-8859-1"?>
                            <mysite>
                                <value>
                                        <id>'.$result->current()->userid.'</id>
                                        <username>'.$result->current()->username.'</username>
                                        <fullname>'.$result->current()->fullname.'</fullname>
                                        <email>'.$result->current()->email.'</email>
                                        <created>'.$result->current()->created.'</created>
                                </value>
                                <code>200</code>
                            </mysite>';

                    $xml = simplexml_load_string($xml);
                    return $xml;
                }
            }
            return 0;
        }

        $server = new Zend_Rest_Server();
        $server->addFunction('getUserByID');
        $server->handle();
    }
}