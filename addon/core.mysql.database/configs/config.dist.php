<?php
$config['autoloadernamespaces']['MysqlAddon']       = 'MysqlAddon';
$config['resources']['db']['adapter']               = 'PDO_MYSQL';
$config['resources']['db']['isdefaulttableadapter'] = true;
$config['resources']['db']['params']['host']        = 'localhost';
$config['resources']['db']['params']['dbname']      = 'framework';
$config['resources']['db']['params']['username']    = 'framework';
$config['resources']['db']['params']['password']    = 'changeme';
$config['resources']['db']['params']['charset']     = 'UTF8';  

return $config;
