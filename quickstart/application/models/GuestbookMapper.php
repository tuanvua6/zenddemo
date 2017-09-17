<?php

class Application_Model_GuestbookMapper
{
    protected $_dbTable;

    public function setDbTable($dbTable)
    {
        if (is_string($dbTable)) {
            $dbTable = new $dbTable();
        }
        if (!$dbTable instanceof Zend_Db_Table_Abstract) {
            throw new Exception('Invalid table data gateway provided');
        }
        $this->_dbTable = $dbTable;
        return $this;
    }

    public function getDbTable()
    {
        if (null === $this->_dbTable) {
            $this->setDbTable('Application_Model_DbTable_Guestbook');
        }
        return $this->_dbTable;
    }

    public function save(Application_Model_Guestbook $guestbook)
    {
        $data = array(
            'username' => $guestbook->getUsername(),
            'fullname' => $guestbook->getFullname(),
            'email'   => $guestbook->getEmail(),
            'created' =>  $guestbook->getCreated(),
        );

        if (null == ($userid = $guestbook->getUserId())) {
            unset($data['userid']);
            $this->getDbTable()->insert($data);
        } else {
            $this->getDbTable()->update($data, array('userid = ?' => $userid));
        }
    }
    public function update($userid, Application_Model_Guestbook $guestbook)
    {
        $data = array(
            'username' => $guestbook->getUsername(),
            'fullname' => $guestbook->getFullname(),
            'email'   => $guestbook->getEmail(),
            'created' =>  $guestbook->getCreated(),
        );
        $where = "userid = " . $userid;
        $this->getDbTable()->update($data, $where);
    }

    public function find($userid, Application_Model_Guestbook $guestbook)
    {
        $result = $this->getDbTable()->find($userid);
        if (0 == count($result)) {
            return;
        }
        $row = $result->current();
        $guestbook->setUserId($row->userid)
                  ->setUsername($row->username)
                  ->setFullname($row->fullname)
                  ->setEmail($row->email)
                  ->setCreated($row->created);
    }

    public function fetchAll()
    {
        $resultSet = $this->getDbTable()->fetchAll();
        $entries   = array();
        foreach ($resultSet as $row) {
            $entry = new Application_Model_Guestbook();
            $entry->setUserId($row->userid)
                  ->setUsername($row->username)
                  ->setFullname($row->fullname)
                  ->setEmail($row->email)
                  ->setCreated($row->created);
            $entries[] = $entry;
        }
        return $entries;
    }
}