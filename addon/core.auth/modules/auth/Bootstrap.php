<?php
class Auth_Bootstrap extends \BaseApp\Application\Module\BootstrapAbstract
{
    /**
     * Initialize Zend_Auth
     *
     * @return void
     */
    protected function _initAuth()
    {
        $this->bootstrap('DiContainer');
        $userService = Zend_Registry::get('Auth_DiContainer')->getUserService();
        $userService->getIdentity();
    }
}
