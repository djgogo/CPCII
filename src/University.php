<?php


class University
{
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return StuffId
     */
    public function generateRandomNumericFiveCharacterStuffId() : StuffId
    {
        $rnd_id = uniqid(rand(),1);
        $rnd_id = substr($rnd_id,0,5);

        return new StuffId((int)$rnd_id);
    }
}