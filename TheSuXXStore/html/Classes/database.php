<?php

/**
 * This code is part of the Suxx security demo application
 *
 * *** DO NOT USE IN ANY TYPE OF PRODUCTION ***
 *
 * The application is stripped down and contains various security issues to be found
 * by course attendees. It is not meant to be used as an actual shop application or a
 * base for one.
 *
 * @author Arne Blankerts <arne.blankerts@thephp.cc>
 * @copyright 2011-2012 thePHP.cc - The PHP Consulting Company, Germany
 *
 */
class SuxxDatabase
{

    protected $dsn;
    protected $mysqli;

    public function __construct($dsn)
    {
        $this->dsn = parse_url($dsn);
    }

    public function query($sql)
    {
        if (!$this->mysqli) {
            $this->mysqli = new MySQLi(
                $this->dsn['host'],
                isset($this->dsn['user']) ? $this->dsn['user'] : 'root',
                isset($this->dsn['pass']) ? $this->dsn['pass'] : '1234',
                substr($this->dsn['path'], 1)
            );
        }
        if (func_num_args() > 1) {
            $args = func_get_args();
            $sql = vsprintf($sql, array_slice($args, 1));
        }
        $rc = $this->mysqli->query($sql);
        if (!$rc) {
            throw new Exception($this->mysqli->error, $this->mysqli->errno);
        }
        return new SuxxDatabaseResult($this, $rc);
    }

    public function getInsertId()
    {
        return $this->mysqli->insert_id;
    }

}
