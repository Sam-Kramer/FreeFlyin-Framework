<?php
class ContactWidget extends Widget {

	private $error = array();

	protected function beforeLoad() {
		parent::beforeLoad();
		if(!empty($_POST)) {
			if($this->checkFields()) {
				if($this->checkTimeRequired()) {
					$headers = 	'From: '. $_POST['email'] . "\r\n" .
    							'Reply-To: '.$_POST['email'] . "\r\n" .
    							'X-Mailer: PHP/' . phpversion();
					mail($this->args['email'], $_POST['subject'], $_POST['body'], $headers);	
					$this->error['success'] = "Your message was successfully sent.";
				}
			}		
		}
	}

	public function onLoad() {
		$this->loadView('contact', array('error' => $this->error));		
	}

	private function checkTimeRequired() {
		$mysql = PublicRegistry::dispatch('MysqlStub');
		/**
		* Checks if IP has been stored with us, if not, stores their ip and time, otherwise it checks to make sure they haven't voted in the    * last desired wait time.
		*/
		$address = $_SERVER['REMOTE_ADDR'];
		$time = time();
		$result = $mysql->query("SELECT * FROM ips WHERE ip='$address'");
		if(mysql_num_rows($result) === 0)
			$mysql->query("INSERT INTO ips (ip, contact_time) VALUES ('$address', '$time')");
		else {
			$user = mysql_fetch_array($result);
			$attempts = $user['contact_attempt'] + 1;
			if($attempts > $this->args['max_attempts']) {
				if(($time - $user['contact_time']) < $this->args['wait_time']) {
					$this->error['wait_time'] = 'You can only send a maximum of 3 messages per hour.';
					return false;
				} else {
					$mysql->query("UPDATE ips SET contact_time='$time', contact_attempt='1' WHERE ip='$address'");
				}				
			} else {
				$mysql->query("UPDATE ips SET contact_time='$time', contact_attempt='$attempts' WHERE ip='$address'");	
			}
		}
		mysql_free_result($result);

		return true;		
	}

	private function checkFields() {
		$valid = true;
		$post = $this->registry->register('PostModule');
		$rules = array(
			'subject' 	=>		array('rule' => '%[^A-Za-z0-9 !?.]%',
									'maxlength' => 30,
									'minlength' => 5),
			'body'		=>		array('rule' => '%[^A-Za-z0-9 !?.]%',
										'maxlength' => 300,
										'minlength' => 10)

			);
		$this->error = $post->check($rules);
		if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
			$this->error['email'] = 'You did not input a valid email.';
		if(!empty($this->error))
			$valid = false;

		return $valid;
	}
}
?>