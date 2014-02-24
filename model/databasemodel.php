<?php
class DatabaseModel extends Model {
    
    private $table_name, $db_connection, $index, $data;

    public function __construct($table_name, $index) {
        $this->table_name = $table_name;
        $this->db_connection = PublicRegistry::dispatch('MysqlStub');
        $this->setIndex($index);
    }

    public function setIndex($index) {
    	$this->index = mysql_real_escape_string($index);
    	$this->data = $this->db_connection->fetchArray('SELECT * FROM '.$this->table_name.' WHERE id=\''.$index.'\'');
    }

	public function __set($key, $value) {
        $value = mysql_real_escape_string($value);
        $key = mysql_real_escape_string($key);
		$this->data[0][$key] = $value;
        $this->db_connection->query('UPDATE '.$this->table_name.' SET '.$key.'=\''.$value.'\' WHERE id=\''.$this->index.'\'');
	}

	public function __get($key) {
         $key = mysql_real_escape_string($key);
        if(array_key_exists($key, $this->data[0]))
		  return $this->data[0][$key];
        return null;
	}
}
?>