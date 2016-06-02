<?php
declare(strict_types=1);

interface Query
{
    public function execute() : Page;
}
