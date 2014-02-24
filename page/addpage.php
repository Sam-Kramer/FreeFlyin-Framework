<?php
class AddPage extends AppPage {

	private $user, $messages;

	protected function beforeLoad() {
		parent::beforeLoad();
		$postModel = new PostModel('users');
		$this->setView('add');
		$this->messages = '';
		if(!empty($_POST['submit'])) {
			$postModel->save(array('submit'));
			$this->message = 'Thank you for registering, '.$_POST['name'];
		}
		$this->set('message', $this->message);
	}

	protected function onLoad() {
        $this->loadTemplate('default');
	}
}
?>