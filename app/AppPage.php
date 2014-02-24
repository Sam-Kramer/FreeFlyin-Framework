<?php
class AppPage extends Page {

	/**
	* Used for implying certain rules for all pages, or pages can directly extend the original page class.
	*/
    protected function beforeLoad() {
        parent::beforeLoad();
		PublicRegistry::register('MysqlStub');
    }

}
?>