<?php
class UserTableDataGateway
{

    /**
     * @var PDO
     */
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($id, $realName, $screenName, $eMail)
    {
        $sql = sprintf(
            'REPLACE INTO user VALUES (%s, "%s", "%s", "%s")',
            $id,
            $realName,
            $screenName,
            $eMail
        );
        $this->pdo->query($sql);
    }

    public function findById($id)
    {
        $sql = sprintf('SELECT id, realname, screenname, email FROM user WHERE id=%s', $id);
        $result = $this->pdo->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function findByKey($key, $value)
    {

    }
}
