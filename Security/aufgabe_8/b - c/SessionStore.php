<?php
interface SessionStore
{

    /**
     * @param string  $id
     * @param array   $data
     */
    public function save($id, array $data);

    /**
     * @param string $id
     *
     * @return array
     */
    public function load($id);

}
