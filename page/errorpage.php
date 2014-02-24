<?php
class ErrorPage extends Page {

	protected function beforeLoad() {
        $this->setView('error');
	}

	protected function onLoad() {
        $this->loadTemplate('default');
	}
}
?>