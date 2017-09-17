<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
		  $this->view->headTitle("QHOnline - Zend Layout");
    }

    public function indexAction()
    {
		 echo "<h1>Welcome to Zend Framework - QHOnline.Info"; 
        // action body
		
		
    }


}

