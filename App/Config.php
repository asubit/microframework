<?php

/**
 * Asubit MicroFramework App
 * 
 * @author Antoine Subit
 * @copyright Antoine Subit © 2019
 * @license CeCILL-B [http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html]
 */
class Config {

    /*
     * Get config by key
     */
    public function get($key) {
        // config parameters file
        $config = json_decode(file_get_contents(__DIR__ . '/config/parameters.json'));
        // check if config key is define
        if (property_exists($config, $key)) {
            return $config->$key;
        } else {
            return null;
        }
    }
}
