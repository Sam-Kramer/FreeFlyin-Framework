<?php
class GetModule extends Module {
    public function fetch($index) {
        return (array_key_exists($index, $_GET['url'])) ? $_GET['url'][$index] : null;
    }
}