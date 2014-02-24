<?php
require_once 'settings.php';
require_once 'publicregistry.php';
require_once 'etc/etc.php';

if(!empty($_GET['url'])) {
	$_GET['url'] = explode('/', $_GET['url']);
}

function __autoload($className) {
	if(($path = getClass($className)) != null)
		require_once $path;
}

function getClass($className) {
	$className = strtolower($className);
	if(file_exists(($path = ROOT . DS . 'lib' . DS . $className . '.php'))) {
		return $path;
    } else if(file_exists(($path = ROOT . DS . 'app' . DS . $className . '.php'))) {
        return $path;
	} else if(file_exists(($path = ROOT . DS . 'page' . DS . $className . '.php'))) {
        return $path;
    } else if(file_exists(($path = ROOT . DS . 'model' . DS . $className . '.php'))) {
        return $path;
    }
}

if(empty($_GET)) {
	new DefaultPage();	
} else if($_GET['url'][0] == 'index') {
	new DefaultPage();
} else {
    $page = ucfirst($_GET['url'][0]).'Page';
    if(getClass($page) != null) {
        new $page();
    } else {
        new ErrorPage();
    }
}
?>