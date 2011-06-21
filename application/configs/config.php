<?php
$config['autoloadernamespaces']['BaseApp'] = 'BaseApp';
$config['bootstrap']['path']    = APPLICATION_PATH . DS . 'Bootstrap.php';
$config['bootstrap']['class']   = 'Bootstrap';

$config['pluginPaths']['BaseApp_Application_Resource'] = 'BaseApp' . DS . 'Application' . DS . 'Resource';

$config['resources']['addon']['path'] = ROOT_PATH . DS . 'addon';
$config['resources']['layout']['layoutPath']  = APPLICATION_PATH . DS . 'layouts';
$config['resources']['layout']['layout'] = 'layout';
$config['resources']['modules'] = array();
$config['resources']['view'] = array();
$config['resources']['frontController']['moduleDirectory'] = APPLICATION_PATH . DS . 'modules';
$config['resources']['frontController']['defaultModule'] = 'default';
$config['resources']['frontController']['throwExceptions'] = true;
$config['resources']['frontController']['prefixDefaultModule'] = true;

$file = dirname(__FILE__) . DS . 'config.development.php';
if (file_exists($file)) {
    include_once $file;
}

return $config;
