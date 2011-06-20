<?php
namespace BaseApp\Model;
abstract class ModelAbstract
{
   /**
    * Constructor
    *
    * @param array|\Zend_Config|null $options
    * @return void
    */
    public function __construct($options = null)
    {
        if ($options instanceof \Zend_Config) {
            $options = $options->toArray();
        }
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function setOptions(array $options)
    {
        $classMethods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . $this->_fieldToMethod($key);
            if (in_array($method, $classMethods)) {
                $this->$method($value);
            }
        }
        return $this;
    }
    
    private function _fieldToMethod($name)
    {
        return implode('',array_map('ucfirst', explode('_',$name)));
    }
}
