<?php
$config['autoloadernamespaces']['BaseApp'] = 'BaseApp';
$config['bootstrap']['path']    = 'Zend/Application/Bootstrap/Bootstrap.php';
$config['bootstrap']['class']   = 'Zend_Application_Bootstrap_Bootstrap';

$config['pluginPaths']['BaseApp_Application_Resource'] = 'BaseApp/Application/Resource';

$config['resources']['addon']['path'] = ROOT_PATH . '/addon';
$config['resources']['layout']['layoutPath']  = APPLICATION_PATH . '/layouts';
$config['resources']['layout']['layout'] = 'layout';
$config['resources']['modules'] = array();
$config['resources']['view'] = array();
$config['resources']['frontController']['moduleDirectory'] = APPLICATION_PATH . '/modules';
$config['resources']['frontController']['defaultModule'] = 'default';
$config['resources']['frontController']['throwExceptions'] = true;
$config['resources']['frontController']['prefixDefaultModule'] = true;

return $config;
