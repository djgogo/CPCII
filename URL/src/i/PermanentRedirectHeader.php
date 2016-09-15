<?php
declare(strict_types = 1);

class PermanentRedirectHeader extends AbstractLocationHeader
{
    /**
     * @var MovedPermanentlyStatusHeader
     */
    private $statusHeader;

    public function __construct(URL $url)
    {
        parent::__construct($url);
        $this->statusHeader = new MovedPermanentlyStatusHeader();
        $this->send();
    }

    protected function send()
    {
        header((string)$this->statusHeader);
        $this->sendStatusMessages();
    }

    private function sendStatusMessages()
    {
        printf("\n *** Header Status: %s \n", $this->statusHeader);
        printf("\n *** Redirected to: %s \n", $this->url);
    }
}
