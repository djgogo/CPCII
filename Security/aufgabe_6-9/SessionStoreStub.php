<?php
class SessionStoreStub implements SessionStore {

    private $stored = array();

    public function save($id, array $data) {
        $this->stored[$id] = $data;
    }

    public function load($id) {
        if (!isset($this->stored[$id])) {
            return array();
        }
        return $this->stored[$id];
    }
}