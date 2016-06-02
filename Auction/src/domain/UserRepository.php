<?php
class UserRepository
{
    private $users = [];

    public function add(User $user)
    {
        $this->ensureUniqueEmail($user);

        $this->users[] = $user;
    }

    private function ensureUniqueEmail(User $user)
    {
        foreach ($this->users as $_user) {
            if ($user->getEmail() == $_user->getEmail()) {
                throw new DuplicateEmailException;
            }
        }
    }
}
