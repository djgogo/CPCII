<?php
declare(strict_types = 1);

class SuxxUserPersistenceIntegrationTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var PHPUnit_Framework_MockObject_MockObject | PDO
     */
    private $pdo;

    /**
     * @var SuxxUserTableDataGateway
     */
    private $gateway;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject | SuxxErrorLogger
     */
    private $logger;

    /**
     * @var PDOException
     */
    private $e;

    protected function setUp()
    {
        $this->logger = $this->getMockBuilder(SuxxErrorLogger::class)->disableOriginalConstructor()->getMock();
        $this->pdo = $this->getMockBuilder(PDO::class)->disableOriginalConstructor()->getMock();
        $this->e = new PDOException();
        $this->gateway = new SuxxUserTableDataGateway($this->pdo, $this->logger);
    }

    public function testIfInsertFailsThrowsExceptionAndErrorWillBeLogged()
    {
        $this->expectException(SuxxCommentTableGatewayException::class);

        $this->pdo
            ->expects($this->once())
            ->method('prepare')
            ->will($this->throwException($this->e));

        $this->logger
            ->expects($this->once())
            ->method('log')
            ->with('Benutzer konnte nicht eingefügt werden.', $this->e);

        $this->gateway->insert(array());
    }
}
