<?php

class SuxxError404Router
{
    /**
     * @var Factory
     */
    private $factory;

    public function __construct(SuxxFactory $factory)
    {
        $this->factory = $factory;
    }
    public function route(SuxxRequest $request) {
        return $this->factory->get404Controller();
    }
}

