<?php

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