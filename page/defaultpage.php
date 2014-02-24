<?php
class DefaultPage extends AppPage {

	private $user;

	protected function beforeLoad() {
		parent::beforeLoad();
		$this->user = new DatabaseModel('users', 1);
		echo $this->user->name;
		$this->user->name = 'Sam';
		echo $this->user->name;
        $this->setView('index');
	}

	protected function onLoad() {
        $this->loadTemplate('default');
	}
}
?>