<?php
class BaseApp_Application_Resource_Addon
    extends Zend_Application_Resource_Modules
{
    protected $_loader;

    public function init()
    {
        $this->_loader = new \BaseApp\Loader\AddonLoader();
        $options = $this->getOptions();
        foreach (new DirectoryIterator($options['path']) as $file) {
            if ($file->isDot() || !$file->isDir()) continue;
            $this->bootstrapAddon($file->getPathname(), $file->getFilename());
        }
        return $this->_bootstraps;
    }

    public function bootstrapAddon($addonDirectory, $addon)
    {
        $this->_loader->setStaticPrefix(dirname($addonDirectory));
        if (!$bootstrapClass = $this->_loader->load($addon, true)) return false;
        $addonBootstrap = new $bootstrapClass($this->getBootstrap());
        $addonBootstrap->bootstrap();
        $this->_bootstraps[$addon] = $addonBootstrap;
        return $this->_bootstraps;
    }
}
