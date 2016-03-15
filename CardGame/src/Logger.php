<?php

class Logger implements LoggerInterface
{
    public function log(string $msg, string $color)
    {
        $out = "";
        switch($color) {
            case "red":
                $out = "[31m"; //Red
                break;
            case "green":
                $out = "[32m"; //Green
                break;
            case "yellow":
                $out = "[33m"; //Yellow
                break;
            case "blue":
                $out = "[34m"; //Blue
                break;
            case "magenta":
                $out = "[35m"; //Magenta
                break;
            case "cyan":
                $out = "[36m"; //Cyan
                break;
            case "white":
                $out = "[37m"; //White
                break;
            default:
                $out = "[37m"; //White
        }

        $message = chr(27) . "$out" . "$msg" . chr(27) . "[0m";
        printf("\n $message \n");
    }
}