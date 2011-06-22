<?php
namespace BaseApp\Application\Addon;
abstract class BootstrapAbstract 
    extends \Zend_Application_Bootstrap_BootstrapAbstract
{
    protected function _bootstrap($addon = null)
    {
        if (null === $addon) {
            $addonLoader = new \BaseApp\Loader\AddonLoader();
            $addonLoader->setStaticPrefix($this->_options['resources']['addon']['path']);
            $this->setPluginLoader($addonLoader);
            foreach ($this->getClassResourceNames() as $resource) {
                $this->_executeResource($resource);
            }
            $this->run();
        } elseif (is_string($addon)) {
            $this->_executeResource($addon);
        } elseif (is_array($addon)) {
            foreach ($addon as $r) {
                $this->_executeResource($r);
            }
        }
        return false;
    }

    public function setOptions(array $options)
    {
        $this->_options = $this->mergeOptions($this->_options, $options);
        $options = array_change_key_case($options, CASE_LOWER);
        $this->_optionKeys = array_merge($this->_optionKeys, array_keys($options));
        foreach (new \DirectoryIterator($this->_options['resources']['addon']['path']) as $file) {
            if ($file->isDot() || !$file->isDir()) continue;
            $this->registerPluginResource($file->getFilename(), array());
        }
        return $this;
    }

    protected function _loadPluginResource($resource, $options)
    {
        // if they didn't cast to an array, we'd only need this line here:
        // parent::_loadPluginResource($resource, $this->getApplication());
        $className = $this->getPluginLoader()->load(strtolower($resource), false);
        if (!$className) {
            return false;
        }
        $instance = new $className($this->getApplication());
        unset($this->_pluginResources[$resource]);
        if (isset($instance->_explicitType)) {
            $resource = $instance->_explicitType;
        }
        $resource = strtolower($resource);
        $this->_pluginResources[$resource] = $instance;
        return $resource;
    }

    public function init()
    {
        return $this->bootstrap();
    }

    public function run()
    {
        $r    = new \ReflectionClass($this);
        $directory  = dirname($r->getFileName());
        $configFile = $directory . '/config.php';
        if (!file_exists($configFile)) return;
        $config = include_once($configFile);
        if (is_array($config)) {
            $bootstrap = $this->getApplication();
            // @TODO: Allow for various APPLICATION_ENV configs
            $bootstrap->setOptions($bootstrap->mergeOptions($bootstrap->getOptions(), $config));
            // This is for autoloadernamespaces / etc
            $application = $bootstrap->getApplication();
            $application->setOptions($config);
        }

        // load modules
        $modulesDir = $directory . '/modules';
        if (is_dir($modulesDir)) {                
            \Zend_Controller_Front::getInstance()->addModuleDirectory($modulesDir);
        }

        $libraryDir = $directory . '/library';
        if (is_dir($libraryDir)) {                
            set_include_path(implode(PATH_SEPARATOR, array(get_include_path(), $libraryDir)));
        }
        return null;
    }
}
