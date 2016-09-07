<?php
class UserMapper {

    /**
     * @var UserTableDataGateway
     */
    private $gateway = NULL;


    public function __construct(UserTableDataGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param User $user
     */
    public function save(User $user)
    {
        $this->gateway->insert(
            $user->getId(),
            $user->getScreenName(),
            $user->getRealName(),
            $user->getEmail()
        );
    }

    public function create(array $data)
    {
        $user = new User($data['id'], $data['realname'], $data['email']);
        $user->setScreenName($data['screenname']);
        return $user;
    }

}
