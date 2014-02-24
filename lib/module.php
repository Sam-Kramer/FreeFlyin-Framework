<?php
class Module {

	private $data;
    protected $args, $registry;
        
    public function __construct($args = array()) {
        $this->args = $args;
        $this->registry = new Registry();
    }

	public function __set($key, $value) {
		$this->data[$key] = $value;
	}

	public function __get($key) {
		return $this->data[$key];
	}
}
?>