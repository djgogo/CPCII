<?php
class SessionStoreStub implements SessionStore
{
    private $stored = array();

    public function save($id, array $data)
    {
        $this->stored[(string) $id] = $data;
    }

    public function load($id)
    {
        if (!isset($this->stored[(string) $id])) {
            return array();
        }
        return $this->stored[(string) $id];
    }
}
