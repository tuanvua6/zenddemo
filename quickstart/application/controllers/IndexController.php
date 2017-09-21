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
        $client = new Zend_Rest_Client('http://quickstart.local/Restapi/id/list');
        foreach ($client ->get()->response as $row)
        {
            $json = json_encode($row);
            echo $json;
        }

    }


}

?>