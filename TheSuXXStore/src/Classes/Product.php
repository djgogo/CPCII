<?php

class SuxxProduct
{
    /**
     * @var int
     */
    private $pid;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $img;

    /**
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $created;

    /**
     * @var string
     */
    private $updated;

    public function getPid() : int
    {
        return $this->pid;
    }

    public function getLabel() : string
    {
        return $this->label;
    }

    public function getImg() : string
    {
        return $this->img;
    }

    public function getPrice() : int
    {
        return $this->price;
    }

    public function getCreated() : string
    {
        return $this->created;
    }

    public function getUpdated() : string
    {
        return $this->updated;
    }
}
