<?php
class RestapiController extends My_Rest_Controller
{
    public function headAction() {

    }
    public function getAction() {
        $functionName = $this->_getParam('id');

        $data = array();
        if ($functionName =='list') {
            $data['response'] = $this->listUsers();
        }

        $data['status'] = 'success';
        $this->sendResponse($data);
    }

    public function postAction() {
        $functionName = $this->_getParam('id');

        if ($functionName=='add') {
            $data = $this->addUsers();
        }
        $data['status'] = 'success';
        $this->sendResponse($data);
    }

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
            $userid = $this->_getParam('userid');
            $username = $this->_getParam('username');
            $fullname = $this->_getParam('fullname');
            $email = $this->_getParam('email');
            $created = $this->_getParam('created');

            $guestbook = new Application_Model_Guestbook();
            $guestbook->setUserId($id)
                         ->setUsername($username)
                         ->setFullname($fullname)
                         ->setEmail($email)
                         ->setCreated($created);

            $mapper  = new Application_Model_GuestbookMapper();
            $user = $mapper->save($guestbook);

            return $user;
        }
        catch (Exception $e) {
            return $e;
        }
    }


}

?>