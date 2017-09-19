<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
		//  $this->view->headTitle("QHOnline - Zend Layout");
    }

    public function indexAction()
    {
        function sayHello()
        {
            $xml ='<?xml version="1.0" encoding="ISO-8859-1"?>
                    <mysite>
                        <value>Hey $who! Hope you\'re having a good $when</value>
                        <code>200</code>
                    </mysite>';

            $xml = simplexml_load_string($xml);
            return $xml;
        }

        $server = new Zend_Rest_Server();
        $server->addFunction('sayHello');

        $server->handle();

    }


}

?>