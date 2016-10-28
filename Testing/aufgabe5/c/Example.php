<?php

class Example
{
    public function returnInput($x, $condition1, $condition2, $condition3)
    {
        if ($condition1) {
            $x++;
        }

        if ($condition2) {
            $x--;
        }

        if ($condition3) {
            // ...
        }

        return $x;
    }
}

