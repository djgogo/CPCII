<?php
declare(strict_types = 1);

class LocationHeader
{
    /**
     * @var URL
     */
    private $url;

    public function __construct(URL $url)
    {
        $this->url = $url;
    }

    public function send(AbstractHTTPStatusHeader $statusHeader)
    {
        header((string)$statusHeader);
        printf("\n *** Header Status: %s sendet \n", $statusHeader);
    }

    public function __toString() : string
    {
        return (string) $this->url;
    }
}
