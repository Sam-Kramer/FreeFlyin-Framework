<?php
class MysqlStub extends Module {

	public function __construct($mysql_host = MYSQL_HOST, $mysql_user = MYSQL_USERNAME, $mysql_password = MYSQL_PASSWORD, $mysql_db = MYSQL_DATABASE) {
		mysql_pconnect($mysql_host, $mysql_user, $mysql_password) or die(mysql_error());
		mysql_select_db($mysql_db) or die (mysql_error());
	}
	

	public function query($query) {
		return mysql_query($query);
	}

    public function fetch($query) {
        $result = $this->query($query);
        $data = mysql_fetch_assoc($result);
        mysql_free_result($result);
        return $data;
    }

	public function fetchArray($query) {
		$data = array();
		$result = $this->query($query);
		while($row = mysql_fetch_assoc($result)) {
			$data[] = $row;
		}
		mysql_free_result($result);
		return $data;
	}

    public function countRows($query) {
        $result = mysql_query($query);
        return mysql_num_rows($result);
    }
}
?>