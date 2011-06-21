<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initAddonLoader()
    {
        $this->bootstrap('addon');
    }
}
