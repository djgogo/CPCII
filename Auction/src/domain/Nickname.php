<?php
declare(strict_types=1);

class Nickname
{
    private $nickname;

    public function __construct(string $nickname)
    {
        $this->ensureNotEmpty($nickname);

        $this->nickname = $nickname;
    }

    private function ensureNotEmpty(string $nickname)
    {
        if (empty(trim($nickname))) {
            throw new EmptyNicknameException;
        }
    }
}
