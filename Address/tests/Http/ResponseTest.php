<?php
namespace Address\Http {

    use Address\Entities\Address;
    use Address\Entities\Text;

    /**
     * @covers Address\Http\Response
     * @uses   Address\Entities\Address
     * @uses   Address\Entities\Text
     */
    class ResponseTest extends \PHPUnit_Framework_TestCase
    {
        /** @var array */
        private $addresses;

       /** @var Address */
        private $address;

        /** @var array */
        private $texts;

        /** @var Text */
        private $text;

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

            $this->texts = [
                new Text(
                    [
                        'id' => 1,
                        'text1' => 'Lorem Ipsum',
                        'text2' => 'Lorem Ipsum Dolor'
                    ]
                ),
                new Text(
                    [
                        'id' => 2,
                        'text1' => 'Lorem Ipsum Dolor',
                        'text2' => 'Lorem Ipsum Dolor Sit Amet'
                    ]
                )
            ];

            $this->text = new Text(
                [
                    'id' => 1,
                    'text1' => 'Lorem Ipsum',
                    'text2' => 'Lorem Ipsum Dolor'
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
            $this->response->setAddresses($this->addresses);
            $this->assertEquals($this->addresses, $this->response->getAddresses());
        }

        public function testTextCanBeSetAndRetrieved()
        {
            $this->response->setText($this->text);
            $this->assertEquals($this->text, $this->response->getText());
        }

        public function testTextsCanBeSetAndRetrieved()
        {
            $this->response->setTexts($this->texts);
            $this->assertEquals($this->texts, $this->response->getTexts());
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
