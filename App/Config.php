<?php

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
