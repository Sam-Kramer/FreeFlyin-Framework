<?php
define('NAME', 'FreeFlyin Framework');
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define('URL', 'http://'.$_SERVER["SERVER_NAME"].dirname($_SERVER['PHP_SELF']));
define('CURRENT_URL', 'http://'.$_SERVER["SERVER_NAME"].$_SERVER['REQUEST_URI']);
define('MEDIA', URL.'/media');

define('MYSQL_HOST', 'localhost');
define('MYSQL_USERNAME', 'root');
define('MYSQL_PASSWORD', '');
define('MYSQL_DATABASE', 'freeflyin');

define('TEMPLATE', 'template');
define('WAIT_TIME', 3600);
?>