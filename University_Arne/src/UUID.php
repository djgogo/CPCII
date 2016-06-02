<?php
declare(strict_types = 1);

abstract class UUID
{
    /**
     * @return string
     */
    protected function generateUUID() : string
    {
        if (function_exists('com_create_guid')){
            return com_create_guid();
        }
        else {
            $charId = strtoupper(md5(uniqid((string)rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid =  substr($charId, 0, 8).$hyphen
                    .substr($charId, 8, 4).$hyphen
                    .substr($charId,12, 4).$hyphen
                    .substr($charId,16, 4).$hyphen
                    .substr($charId,20,12);
            return $uuid;
        }
    }
}