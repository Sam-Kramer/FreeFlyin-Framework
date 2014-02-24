<?php
class HtmlModule extends Module {
    public function loadJs() {
        foreach(PublicRegistry::getJs() as $js)
            echo '<script type="text/javascript" src="'.$js['location'].$js['file'].'.js"></script>';
    }

    public function loadCss() {
        foreach(PublicRegistry::getCss() as $css) {
            echo '<link rel="stylesheet" href="'.$css['location'].$css['file'].'.css" type="text/css" media="screen" charset="utf-8" />';
        }
    }

    public function image($image, $alt = "") {
        return '<img src="'.MEDIA.'/images/'.$image.'" alt="'.$alt.'" />';
    }
    
    public function link($name, $location) {
        return '<a href="'.$location.'">'.$name.'</a>';
    }
}
