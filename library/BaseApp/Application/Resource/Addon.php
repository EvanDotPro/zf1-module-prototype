<?php
class BaseApp_Application_Resource_Addon
    extends Zend_Application_Resource_Modules
{
    public function init()
    {
        $options = $this->getOptions();
        foreach (new DirectoryIterator($options['path']) as $file) {
            if ($file->isDot() || !$file->isDir()) continue;
            //$this->loadAddon($file->getPathname());
            $this->bootstrapAddon($file->getPathname(), $file->getFilename());
        }
    }

    public function bootstrapAddon($addonDirectory, $addon)
    {
        $bootstrapClass = $this->_formatModuleName($addon) . '_Bootstrap';
        if (!class_exists($bootstrapClass, false)) {
            $bootstrapPath  = $addonDirectory . '/Bootstrap.php';
            if (file_exists($bootstrapPath)) {
                include_once $bootstrapPath;
                if (!class_exists($bootstrapClass, false)) {
                    throw new Zend_Application_Resource_Exception('Addon bootstrap class not found');
                }
                $addonBootstrap = new $bootstrapClass($this->getBootstrap());
                $addonBootstrap->bootstrap();
                $this->_bootstraps[$addon] = $addonBootstrap;
                return $this->_bootstraps;
            } else {
                return;
            }
        }
        return;
    }
}
