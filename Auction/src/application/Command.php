<?php
declare(strict_types=1);

interface Command
{
    public function execute() : Redirect;
}
