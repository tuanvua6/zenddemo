<?php

class Application_Form_Adduser extends Zend_Form
{
    public function init()
    {
        // Set the method for the display form to POST
        $this->setMethod('post');

        // Add an userid element
        $this->addElement('hidden', 'userid', array(
                'required' => false,
            ));
        // Add an username element
        $this->addElement('text', 'username', array(
            'label'      => 'Username:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty',
            )
        ));
        // Add an fullname element
        $this->addElement('text', 'fullname', array(
            'label'      => 'Fullname:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty',
            )
        ));
        // Add an email element
        $this->addElement('text', 'email', array(
            'label'      => 'Email:',
            'required'   => true,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'EmailAddress',
            )
        ));

        // Add the comment element
        $this->addElement('text', 'created', array(
            'label'      => 'DateCreated:',
            'required'   => false,
            'filters'    => array('StringTrim'),
            'validators' => array(
                'NotEmpty',
            )
        ));

        // Add a captcha
        ////////$this->addElement('captcha', 'captcha', array(
        ////////    'label'      => 'Vui lòng nhập mã Xác nhận:',
        ////////    'required'   => true,
        ////////    'captcha'    => array(
        ////////        'captcha' => 'Figlet',
        ////////        'wordLen' => 5,
        ////////        'timeout' => 300
        ////////    )
        ////////));

        // Add the submit button
        $this->addElement('submit', 'submit', array(
            'ignore'   => true,
            'label'    => 'Lưu lại',
        ));

        // And finally add some CSRF protection
        $this->addElement('hash', 'csrf', array(
            'ignore' => true,
        ));
    }
}