<?php
class Widget {

	private $data;
	protected $args, $registry;

	public final function __construct($args = array()) {
		$this->args = $args;
		$this->registry = new Registry();
		$this->beforeLoad();
	}


	protected function beforeLoad() {
		if(($mysql = PublicRegistry::dispatch('MysqlStub')) == null)
			$mysql = PublicRegistry::register('MysqlStub');
	}

	public function onLoad() {
	}

	protected function loadView($view, $data = '') {
		if(is_array($data))
			extract($data, EXTR_PREFIX_SAME, 'wddx');
		require_once ROOT . DS . 'display' . DS . 'widget' . DS . $view . '.php';
	}

	public function __set($key, $value) {
		$this->data[$key] = $value;
	}

	public function __get($key) {
		return (array_key_exists($key, $this->data)) ? $this->data[$key] : null;
	}
}
?>