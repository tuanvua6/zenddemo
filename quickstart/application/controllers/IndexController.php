<?php

class IndexController extends Zend_Controller_Action
{
    public function init()
    {
        /* Initialize action controller here */
		//  $this->view->headTitle("QHOnline - Zend Layout");
    }
    //get list
    //public function indexAction()
    //{
    //    $client = new Zend_Rest_Client('http://quickstart.local/Restapi/id/list');
    //    foreach ($client ->get()->response as $row)
    //    {
    //        $json = json_encode($row);
    //        echo $json;
    //    }

    //}

    //insert data từ rest api
    public function indexAction()
    {
        // Step 1. Instantiate the Zend_Rest_Client
        $client = new Zend_Rest_Client("http://quickstart.local");
        $url = "Restapi";
        $errors = array();
        $post_data = array(
            'method' => 'addUsers',
            'id'  => 'add',
            'username'   => 'long.hoang',
            'fullname' => 'nguyen hoang long',
            'email' => 'long.hoang@gmail.com',
            'created' => '01/01/2017'
        );
        try {
            $result = ($client->restPost($url, $post_data));
        }
        catch(Zend_Rest_Client_Exception $e) {
            $errors[] = '[' . $e->getCode() . ']:' . $e->getMessage();
        }
        catch (Exception $e) {
            $errors[] = '[' . $e->getCode() . ']:' . $e->getMessage();
        }
        if($errors) {
            print_r($errors);
        }
        else {
            print_r($result->getBody());
        }
    }

}

?>