<?php
declare(strict_types=1);

class UserRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function testCannotAddUserWithAlreadyExistingEmail()
    {
        $repository = new UserRepository;

        $repository->add(
            new User(new Nickname('Foo'), new Email('admin@example.com'))
        );

        $this->expectException(DuplicateEmailException::class);

        $repository->add(
            new User(new Nickname('Bar'), new Email('admin@example.com'))
        );
    }
}
