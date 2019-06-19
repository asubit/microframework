<?php

require_once 'App/Config.php';

/**
 * Asubit MicroFramework App
 * 
 * @author Antoine Subit
 * @copyright Antoine Subit © 2019
 * @license CeCILL-B [http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html]
 */
class Theme extends Config {

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