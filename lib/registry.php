<?php
class Registry {

    private $css = array();
    private $js = array();
	private $modules = array();

	public function register($module, $args = '') {
		if(file_exists(($path = ROOT . DS . 'module' . DS . strtolower($module) . '.php'))) {
			require_once $path;
			$this->modules[$module] = new $module($args);
			return $this->modules[$module];
		} else {
			return null;
		}
	}

	public function dispatch($module) {
		return (array_key_exists($module, $this->modules)) ? $this->modules[$module] : null;
	}

    public function importCss($css, $location = '') {
        if($location == '')
            $location = MEDIA.'/css/';
        $this->css[] = array('file' => $css, 'location' => $location);
    }

    public function getCss() {
        return $this->css;
    }

    public function importJs($js, $location = '') {
        if($location == '')
            $location = MEDIA.'/js/';
        $this->js[] = array('file' => $js, 'location' => $location);
    }

    public function getJs() {
        return $this->js;
    }
}
?>