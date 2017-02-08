<?php
namespace Address\Http {

    use Address\Entities\Address;

    /**
     * @covers Address\Http\Response
     * @uses Address\Entities\Address
     */
    class ResponseTest extends \PHPUnit_Framework_TestCase
    {
        /** @var array */
        private $addresses;

       /** @var Address */
        private $address;

        /** @var String */
        private $redirect;

        /** @var Response */
        private $response;

        protected function setUp()
        {
            $this->addresses = [
                new Address(
                    [
                    'id' => 1,
                    'address1' => 'Obi-Van Kenobi',
                    'address2' => 'Saturn Ave.'
                    ]
                ),
                new Address(
                    [
                    'id' => 2,
                    'address1' => 'Luke Skywalker',
                    'address2' => 'Earth Road'
                    ]
                )
            ];

            $this->address = new Address(
                [
                    'id' => 1,
                    'address1' => 'Obi-Van Kenobi',
                    'address2' => 'Saturn Ave.'
                ]
            );

            $this->redirect = '/goSomeWhere';
            $this->response = new Response();
        }

        public function testAddressCanBeSetAndRetrieved()
        {
            $this->response->setAddress($this->address);
            $this->assertEquals($this->address, $this->response->getAddress());
        }

        public function testAddressesCanBeSetAndRetrieved()
        {
            $this->response->setAddresses(...$this->addresses);
            $this->assertEquals($this->addresses, $this->response->getAddresses());
        }

        public function testRedirectCanBeSetAndRetrieved()
        {
            $this->response->setRedirect($this->redirect);
            $this->assertEquals($this->redirect, $this->response->getRedirect());
        }

        public function testHasRedirectReturnsRightBoolean()
        {
            $this->response->setRedirect($this->redirect);
            $this->assertTrue($this->response->hasRedirect());
        }
    }
}
