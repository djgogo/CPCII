<?php
declare(strict_types = 1);

/**
 * @covers ISBN
 */
class IsbnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider validIsbnProvider
     */
    public function testValidISBN($number)
    {
        $isbn = new ISBN($number);
        $this->assertSame($number, (string)$isbn);
    }

    /**
     * @dataProvider invalidIsbnProvider
     */
    public function testInvalidISBN($number)
    {
        $this->expectException('InvalidIsbnException');
        new ISBN($number);
    }

    public function validIsbnProvider()
    {
        return [
            ['978-3-446-41394-8'],
            ['978-3-89864-450-1'],
            ['978-0-470-87249-9'],
            ['978-0-307-58778-7'],
            ['978-3-86680-192-9'],
            ['979-10-90636-07-1']
        ];
    }

    public function invalidIsbnProvider()
    {
        return [
            ['977-3-446-41394-8'],
            ['978-3-89864-451-1'],
            ['978-8-470-87249-9'],
            ['978-0-307-57878-7'],
            ['979-09-90636-07-1'],
            ['979-3-90636-07-1']
        ];
    }
}
