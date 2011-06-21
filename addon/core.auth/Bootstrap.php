<?php
class CoreAuth_Bootstrap extends \BaseApp\Application\Addon\BootstrapAbstract
{
    protected function _initDbAddon()
    {
        $this->bootstrap('core.mysql.database');
    }
}
