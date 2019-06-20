<?php

/**
 * Asubit MicroFramework App
 * 
 * @author Antoine Subit
 * @copyright Antoine Subit © 2019
 * @license CeCILL-B [http://www.cecill.info/licences/Licence_CeCILL-B_V1-en.html]
 */
class Model {

    public __construct($model) {}

    protected $id;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
}