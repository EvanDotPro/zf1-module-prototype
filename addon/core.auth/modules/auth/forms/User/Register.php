<?php
class Auth_Form_User_Register extends Auth_Form_User_Base
{
    public function init()
    {
        parent::init();
        $this->removeElement('userId');
        $this->removeElement('role');
        $this->getElement('submit')->setLabel('Register');
    }
}
