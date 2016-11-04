<?php

class LegacyController
{
    public function performAction()
    {
        global $userId;

        $db = new PDO(DSN);

        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $statement = $db->prepare('SELECT * FROM users WHERE id=:user;');

        $statement->bindValue(':user', $userId, PDO::PARAM_INT);

        $statement->execute();

        $record = $statement->fetch(PDO::FETCH_ASSOC);

        // ...

        print 'something';
    }
}

