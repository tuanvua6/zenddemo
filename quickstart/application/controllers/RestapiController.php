<?php
class RestapiController extends My_Rest_Controller
{
    public function headAction() {

    }
    public function getAction() {

        $request = $this->getRequest();
        $functionName = $request->getParam('id');

        $data = array();
        if ($functionName = 'list') {
            $data['response'] = $this->listUsers();
        }

        $data['status'] = 'success';
        $this->sendResponse($data);
    }

    public function postAction() {

        $functionName = $this->_getParam('id');
        $request = $this->getRequest();
        $functionName = $request->getParam('id');

        if ($functionName=='add') {
            $data = $this->addUsers();
            if($data = true)
                $data['status'] = 'success';
            else
                $data['status'] = 'fail';
        }
        $this->sendResponse($data);
    }

    //protected function addAnnouncement() {

    //    $type = $this->_getParam('type');
    //    $title = $this->_getParam('title');
    //    $text = $this->_getParam('text');

    //    $response = array(
    //            'id' => '33344'
    //    );

    //    return $response;

    //}

	/**
	 * list all announcements
	 */
	protected function listUsers() {

        $guestbook = new Application_Model_GuestbookMapper();
        $listUser =new Application_Model_Guestbook();
        $listUser = $guestbook->fetchAll();
               
        $data = array();
        foreach ($listUser as $row)
        {
            $data['UserInfor'.$row->getUserId()] = array (
                    'userid' => $row->getUserId(),
                    'username' => $row->getUsername()
                );
        }

        return $data;
    }
    protected function addUsers() {
        try{
            $guestbook = new Application_Model_Guestbook();
            $guestbook->setUserId($id)
                         ->setUsername($username)
                         ->setFullname($fullname)
                         ->setEmail($email)
                         ->setCreated($created);

            $mapper  = new Application_Model_GuestbookMapper();
            $mapper->save($guestbook);
            return true;
        }
        catch (Exception $e) {
            return $e;
        }
    }


}

?>