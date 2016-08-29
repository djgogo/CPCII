<?php
class UserRepository
{

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
    public function getUserById($id) : User
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

    public function findUserByScreenName($value) : User
    {
        $data = $this->gateway->findByScreenName($value);
        return $this->mapper->create($data);
    }

    public function findUserByEmail($value) : User
    {
        $data = $this->gateway->findByEmail($value);
        return $this->mapper->create($data);
    }

    public function commit()
    {
        foreach ($this->users as $user) {
            $this->mapper->save($user);
        }
    }
}
