<?php

namespace Address\ValueObjects {

    use Address\Exceptions\InvalidEmailException;

    /**
     * @covers Address\ValueObjects\Email
     */
    class EmailTest extends \PHPUnit_Framework_TestCase
    {
        public function testHappyPath()
        {
            $emailString = 'foo@bar.com';
            $email = new Email($emailString);
            $this->assertEquals($emailString, $email);
        }

        /**
         * @dataProvider invalidEmailProvider
         * @param $invalidEmail
         */
        public function testThrowsExceptionOnEmail(string $invalidEmail)
        {
            $this->expectException(InvalidEmailException::class);
            new Email($invalidEmail);
        }

        public function invalidEmailProvider(): array
        {
            return [
                ['invalid'],
                ['invalid@'],
                ['invalid@invalid'],
                ['invalid@.invalid'],
                ['@invalid.ch'],
                [str_repeat('x', 50) . '@unittest.ch']
            ];
        }
    }
}
