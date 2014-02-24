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

	/*
	* Simple check, condensed $rules
	* example:  array('password', '%[^A-Za-z0-9 !?.]%', 3, 30)
	*/
	public function sCheck($rules) {
		$error = array();
		foreach($rules as $rule => $data) {
			if(!array_key_exists($rule, $_POST)) {
				if(array_key_exists(2, $data)) {
					if($data[2] > 0)
						$error[$rule] = 'Your '.$rule.' does not contain enough characters, the minimum is '.$data[2].'.';	
				} 
			} else {
				if(array_key_exists('1', $data)) {
					if(!(!preg_match($data[1], $_POST[$rule])))
						$error[$rule] = (array_key_exists('msg', $data)) ? $data['msg'] : 'Invalid characters.';
				} 

				if(array_key_exists('2', $data)) {
					if(strlen($_POST[$rule]) < $data[2])
						$error[$rule] = 'Your '.$rule.' does not contain enough characters, the minimum is '.$data[2].'.';	
				}

				if(array_key_exists('3', $data)) {
					if(strlen($_POST[$rule]) > $data[3])
						$error[$rule] = 'Your '.$rule.' contains too many characters, the maximum is '.$data[3].'.';
				} 		
			}
		}

		return $error;
	}
}
?>