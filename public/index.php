<?php
/**
 * @author Denysaw
 */
ini_set('display_errors', true);
error_reporting(E_ALL);

define('APP_PATH', dirname(__DIR__). '/src');
define('VIEWS', dirname(__DIR__). '/src/views');

spl_autoload_extensions(".php");
spl_autoload_register(function($class) {
    $parts = explode('\\', $class);
    $class = array_pop($parts);
    array_shift($parts);

    $dirs = implode('/', array_map(function($dir) {
        return strtolower($dir);
    }, $parts));

    $path = APP_PATH. '/'. $dirs. '/'. $class. '.php';

    if (file_exists($path)) {
        include_once $path;
	} else {
        die('Fatal error: cannot load class '. $class. ' at '. $path);
    }
});

require_once APP_PATH. '/routes.php';