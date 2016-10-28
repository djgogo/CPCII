<?php

class SuxxStaticView implements SuxxViewInterface
{
    protected $staticFile;

    public function __construct($filename)
    {
        $this->staticFile = $filename;
    }

    public function render(SuxxRequest $request, SuxxSession $session, SuxxResponse $response)
    {
        ob_start();
        include $this->staticFile;
        $html = ob_get_clean();
        return $html;
    }
}
