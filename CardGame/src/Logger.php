<?php

abstract class Logger
{
    static function log(string $msg)
    {
        printf("\n $msg \n");
    }
}