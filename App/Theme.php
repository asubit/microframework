<?php

include ('App/Config.php');

class Theme {

    public function getTheme() {
        $config = new Config();
        return $config->get('theme');
    }

    public function getHeader() {
        return $this->getTheme() . '/header.php';
    }

    public function getFooter() {
        return $this->getTheme() . '/footer.php';
    }
}