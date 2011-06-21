<?php
namespace BaseApp\Loader;
class AddonLoader extends \Zend_Loader_PluginLoader
{
    protected $_staticPrefix;

    public function load($name, $throwExceptions = true)
    {
        $dirName = $name;
        $name = $this->_formatName($name);
        if ($this->isLoaded($name)) {
            return $this->getClassName($name);
        }

        $found     = false;
        $classFile = 'Bootstrap.php';
        $className = $name . '_Bootstrap';

        if (class_exists($className, false)) {
            $found = true;
            return $className;
            break;
        }

        $loadFile = $this->getStaticPrefix() . '/' . $dirName . '/' . $classFile;
        if (\Zend_Loader::isReadable($loadFile)) {
            include_once $loadFile;
            if (class_exists($className, false)) {
                $found = true;
                return $className;
            }
        }

        if (!$found) {
            return false;
        }
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
