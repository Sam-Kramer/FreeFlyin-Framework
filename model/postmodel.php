<?php
class PostModel extends Model {
    
    private $table_name, $db_connection, $data;

    public function __construct($table_name) {
        $this->table_name = $table_name;
        $this->db_connection = PublicRegistry::dispatch('MysqlStub');
        $this->data = $_POST;
    }

    public function save($omits = array()) {
        $save_data = $this->data;
        $fields = '';
        $values = '';

        foreach($omits as $omit)
            unset($save_data[$omit]);

        foreach($save_data as $key => $data) {
            $key = mysql_real_escape_string($key);
            $data = mysql_real_escape_string($data);
            $fields .= $key.', ';
            $values .= '\''.$data.'\', ';
        }

        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');

        $this->db_connection->query('INSERT INTO '.$this->table_name.' ('.$fields.') VALUES ('.$values.')');
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