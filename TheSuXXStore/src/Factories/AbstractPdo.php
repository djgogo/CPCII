<?php

abstract class AbstractPdo
{
    protected function getPdo($host, $dbName, $user, $pass) : PDO
    {
        try {
            $db = new PDO(
                "mysql:host=$host;dbname=$dbName",
                $user,
                $pass
            );
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
        return null;
    }
}

