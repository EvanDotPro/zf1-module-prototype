<?php
namespace BaseApp\Application\Module;
abstract class BootstrapAbstract
    extends \Zend_Application_Module_Bootstrap
{
    protected function _initDiContainer()
    {
        $module = $this->getModuleName();
        $class  = $module . '_DiContainer';
        $r    = new \ReflectionClass($this);
        $dir  = $r->getFileName();
        if (!class_exists($class, false)) {
            $file = dirname($dir) . '/DiContainer.php';

            if (file_exists($file)) {
                require_once $file;
            } else {
                return;
            }
        }
        \Zend_Registry::set($class, new $class());
    }
}
