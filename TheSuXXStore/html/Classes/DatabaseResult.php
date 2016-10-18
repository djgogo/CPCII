<?php
declare(strict_types = 1);

class SuxxDatabaseResult
{

    protected $result;
    protected $db;

    public function __construct(SuxxDatabase $db, $rc)
    {
        $this->db = $db;
        $this->result = $rc;
    }

    public function getAll()
    {
        $data = array();
        while ($x = $this->result->fetch_object()) {
            $data[] = $x;
        }
        return $data;
    }

    public function getInsertId()
    {
        return $this->db->getInsertId();
    }

    public function __call($method, $params)
    {
        return call_user_func_array(array($this->result, $method), $params);
    }

    public function __get($var)
    {
        return $this->result->$var;
    }

}


