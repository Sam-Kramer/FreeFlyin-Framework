<?php
class PostModule extends Module {
	public function check($rules) {
		$error = array();
		foreach($rules as $rule => $data) {
			if(array_key_exists('rule', $data)) {
				if(!(!preg_match($data['rule'], $_POST[$rule])))
					$error[$rule] = (array_key_exists('msg', $data)) ? $data['msg'] : 'Invalid characters.';
			} 

			if(array_key_exists('maxlength', $data)) {
				if(strlen($_POST[$rule]) > $data['maxlength'])
					$error[$rule] = 'Your field contains too many characters, the maximum is '.$data['maxlength'].'.';
			} 

			if(array_key_exists('minlength', $data)) {
				if(strlen($_POST[$rule]) < $data['minlength'])
					$error[$rule] = 'Your field  does not contain enough characters, the minimum is '.$data['minlength'].'.';	
			}
		}

		return $error;
	}
}
?>