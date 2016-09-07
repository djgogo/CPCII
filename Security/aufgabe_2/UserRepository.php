<?php
class UserRepository {

    /**
     * @var UserTableDataGateway
     */
    private $gateway;

    /**
     * @var UserMapper
     */
    private $mapper;

    /**
     * @var array
     */
    private $users = array();

    public function __construct(UserTableDataGateway $gateway, UserMapper $mapper)
    {
        $this->gateway = $gateway;
        $this->mapper = $mapper;
    }

    /**
     * @param integer $id A User-Id
     *
     * @return User
     */
    public function getUserById($id)
    {
        if (!isset($this->users[$id])) {
            $data = $this->gateway->findById($id);
            $this->users[$id] = $this->mapper->create($data);
        }
        return $this->users[$id];
    }

    /**
     * @param User $user
     */
    public function addUser(User $user)
    {
        $this->users[$user->getId()] = $user;
    }

    /**
     * @param string $key   Key to use for searching, valid keys are screenname or eMail
     * @param string $value Value to use in search
     */
    public function findUserByKey($key, $value)
    {
        $data = $this->gateway->findByKey($key, $value);
        return $this->mapper->create($data);
    }

    public function commit()
    {
        foreach($this->users as $user) {
            $this->mapper->save($user);
        }
    }
}
