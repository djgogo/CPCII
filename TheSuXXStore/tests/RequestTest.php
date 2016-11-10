<?php

class SuxxRequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var array
     */
    private $input;

    /**
     * @var array
     */
    private $params;

    /**
     * @var array
     */
    private $files;

    /**
     * @var array
     */
    private $server;

    protected function setUp()
    {
        $this->input = [
            'csrf' => '46c2a3deaef22b8d2bd0bff6587a76f916fb2e44',
            'product' => '1',
            'comment' => 'Test Kommentar'
        ];

        $this->params = [null];

        $this->files = [
            [
                'name' => 'smiley.jpg',
                'type' => 'image/jpeg',
                'tmp_name' => '/tmp/phpF7UTQj',
                'error' => 0,
                'size' => 4447
            ]
        ];

        $this->server = [
            'REQUEST_URI' => '/suxx/comment',
            'REQUEST_METHOD' => 'POST'
        ];

    }


    public function testRequestUriCanBeRetrieved()
    {
        $this->assertEquals('');
    }
}
