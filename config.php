<?php

ini_set('error_reporting', 'true');
error_reporting(E_ALL|E_STRCT);

defined('DS')
	or define('DS', DIRECTORY_SEPARATOR);

defined('BASE_PATH')
	or define('BASE_PATH', realpath(dirname(__FILE__)));

defined('APP_PATH')
	or define('APP_PATH', realpath(BASE_PATH . DS . 'app'));

defined('OBJECTS_PATH')
	or define('OBJECTS_PATH', realpath(APP_PATH . DS . 'objects'));

defined('CORE_PATH')
	or define('CORE_PATH', realpath(BASE_PATH . DS . 'core'));

defined('CLASS_PATH')
	or define('CLASS_PATH', realpath(CORE_PATH . DS . 'classes'));