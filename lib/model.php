<?php
class Model {
    
    private $data = array();

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    /**
     * @param $key
     * @return null
     */
    public function __get($key) {
        return (array_key_exists($key, $this->data)) ? $this->data[$key] : null;
    }
}
?>