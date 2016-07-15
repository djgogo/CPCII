<?php
declare(strict_types = 1);

class TemporaryRedirectHeader extends AbstractLocationHeader
{
    /**
     * @var TemporaryRedirectedStatusHeader
     */
    private $statusHeader;

    public function __construct(URL $url)
    {
        parent::__construct($url);
        $this->statusHeader = new TemporaryRedirectedStatusHeader();
        $this->send();
    }

    protected function send()
    {
        header((string)$this->statusHeader);
        $this->sendStatusMessages();
    }

    private function sendStatusMessages()
    {
        printf ("\n *** Header Status: %s sendet \n", $this->statusHeader);
        printf ("\n *** Redirected to: %s \n", $this->url);
    }
}
