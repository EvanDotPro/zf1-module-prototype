<?php
class Mysqladdon_Bootstrap extends \BaseApp\Application\Module\BootstrapAbstract
{
    /**
     * Initialize database
     *
     * @return void
     */
    protected function _initDbMapper()
    {
        $bootstrap = $this->getApplication();
        $bootstrap->bootstrap('db');
        \MysqlAddon\Model\Mapper\DbAbstract::setDefaultAdapter($bootstrap->getResource('db'));
    }
}

