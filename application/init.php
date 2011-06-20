<?php
define('DS', DIRECTORY_SEPARATOR);

// Define path to app root
defined('ROOT_PATH')
	|| define('ROOT_PATH',
	        realpath(dirname(__FILE__) . DS . '..'));

// Define path to application directory
defined('APPLICATION_PATH')
	|| define('APPLICATION_PATH',
			realpath(ROOT_PATH . DS . 'application'));

// Define path to library directory
defined('LIBRARY_PATH')
	|| define('LIBRARY_PATH',
	        realpath(ROOT_PATH . DS . 'library'));

// Define application environment
defined('APPLICATION_ENV')
	|| define('APPLICATION_ENV',
			(getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV')
											: 'production'));

// Set the include path
set_include_path(implode(PATH_SEPARATOR, array(get_include_path(), LIBRARY_PATH)));

try {
    require_once 'Zend/Application.php';
    $application = new Zend_Application(
    	APPLICATION_ENV,
    	APPLICATION_PATH . '/configs/config.php'
    );
    $application->bootstrap();
} catch(Zend_Config_Exception $e){
    die('config fail');
}

$application->run();
