<?php
class BaseApp_Application_Resource_Addon
    extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $options = $this->getOptions();
        foreach (new DirectoryIterator($options['path']) as $file) {
            if ($file->isDot() || !$file->isDir()) continue;
            $this->loadAddon($file->getPathname());
        }
    }

    public function loadAddon($directory)
    {
        $configFile = $directory . DS . 'config.php';
        if (!file_exists($configFile)) return;
        $bootstrap = $this->getBootstrap();
        // @TODO: Allow for various APPLICATION_ENV configs
        $config = include_once($configFile);
        $bootstrap->setOptions($bootstrap->mergeOptions($bootstrap->getOptions(), $config));

        // load modules
        $modulesDir = $directory . DS . 'modules';
        if (is_dir($modulesDir)) {                
            Zend_Controller_Front::getInstance()->addModuleDirectory($modulesDir);
        }
    }
}
