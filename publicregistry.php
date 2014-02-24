<?php

class PublicRegistry {
	private static $registry;

	public function __construct() {
		self::$registry = new Registry();
	}

	public static function register($module, $args = '') {
		return self::$registry->register($module, $args);
	}

	public static function dispatch($module) {
		return self::$registry->dispatch($module);
	}

    public static function importJs($js, $location = '') {
        self::$registry->importJs($js, $location);
    }

    public static function importCss($css, $location = '') {
        self::$registry->importCss($css, $location);
    }

    public static function getJs() {
        return self::$registry->getJs();
    }

    public static function getCss() {
        return self::$registry->getCss();
    }

}

new PublicRegistry();
?>