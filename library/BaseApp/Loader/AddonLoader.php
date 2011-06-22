<?php
namespace BaseApp\Loader;
class AddonLoader extends \Zend_Loader_PluginLoader
{
    protected $_staticPrefix;

    public function load($name, $returnFalse = false)
    {
        $dirName = $name;
        $name = $this->_formatName($name);
        if ($this->isLoaded($name)) {
            if ($returnFalse) return false;
            return $this->getClassName($name);
        }

        $classFile = 'Bootstrap.php';
        $className = $name . '_Bootstrap';

        if (class_exists($className, false)) {
            if ($returnFalse) return false;
            return $className;
        }

        $loadFile = $this->getStaticPrefix() . '/' . $dirName . '/' . $classFile;
        if (\Zend_Loader::isReadable($loadFile)) {
            include_once $loadFile;
            if (class_exists($className, false)) {
                return $className;
            }
        }

        return false;
    }

    protected function _formatName($name)
    {
        $name = strtolower($name);
        $name = str_replace(array('-', '.'), ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        return $name;
    }
 
    /**
     * Get staticPrefix.
     *
     * @return staticPrefix
     */
    public function getStaticPrefix()
    {
        return $this->_staticPrefix;
    }
 
    /**
     * Set staticPrefix.
     *
     * @param $staticPrefix the value to be set
     */
    public function setStaticPrefix($staticPrefix)
    {
        $this->_staticPrefix = $staticPrefix;
        return $this;
    }
} 
