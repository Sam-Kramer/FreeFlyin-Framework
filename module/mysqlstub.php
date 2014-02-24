<?php
class MysqlStub extends Module {

	private $db;

	public function __construct($args) {
		if(!is_array($args))
			$this->db = new mysqli(MYSQL_HOST, MYSQL_USERNAME, MYSQL_PASSWORD, MYSQL_DATABASE);
		else
			$this->db = new mysqli($args[0], $args[1], $args[2], $args[3]);
	}
	
	public function query($query) {
		return $this->db->query($query);
	}

    public function fetch($query) {
        $result = $this->query($query);
        $data = $result->fetch_assoc();
        $this->db->free();
        return $data;
    }

	public function fetchArray($query) {
		$data = array();
		$result = $this->query($query);
		while($row = $result->fetch_assoc()) {
			$data[] = $row;
		}
		$result->free();
		return $data;
	}

    public function countRows($query) {
        $result = $this->query($query);
        return $result->num_rows;
    }
}
?>