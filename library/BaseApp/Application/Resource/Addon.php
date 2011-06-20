<?php
class BaseApp_Application_Resource_Addon
    extends Zend_Application_Resource_ResourceAbstract
{
    public function init()
    {
        $bootstrap = $this->getBootstrap();
        $options = $this->getOptions();
        foreach (new DirectoryIterator($options['path']) as $file) {
            if ($file->isDir() && $file->getFilename() != '.' && $file->getFilename() != '..') {
                $configFile = $file->getPathName() . DS . 'config.php';
                if (!file_exists($configFile)) continue;
                // @TODO: Allow for various APPLICATION_ENV configs
                $config = include_once($configFile);
                $existingConfig = $bootstrap->getOptions();
                $bootstrap->setOptions($bootstrap->mergeOptions($existingConfig, $config));
            }
        }
    }
}
