<?php

use App\Model;

class Page extends Model {
    protected $title;
    protected $content;

    public function getTitle() {
        return $this->getTitle();
    }

    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
        return $this;
    }
}
