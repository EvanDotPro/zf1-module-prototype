<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAddonLoader()
    {
        $this->bootstrap('addon');
    }

    /**
     * Initialize database
     *
     * @return void
     */
    protected function _initDatabase()
    {
        $this->bootstrap('db');
        \BaseApp\Model\Mapper\DbAbstract::setDefaultAdapter($this->getResource('db'));
    }

    /**
     * Initialize Zend_Auth
     *
     * @return void
     */
    protected function _initAuth()
    {
        //$this->bootstrap('db');
        $this->bootstrap('modules');
        $userService = Zend_Registry::get('Default_DiContainer')->getUserService();
        $userService->getIdentity();
    }
}
