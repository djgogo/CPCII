<?php
class Example
{
    public function returnInput($x, $a, $b, $c)
    {
        if (!is_int($x)) {
            throw new InvalidArgumentException;
        }

        if (!is_bool($a)) {
            throw new InvalidArgumentException;
        }

        if (!is_bool($b)) {
            throw new InvalidArgumentException;
        }

        if (!is_bool($c)) {
            throw new InvalidArgumentException;
        }

        if ($a) {
            // ...
            $x++;
            // ...
        }

        if ($b) {
            // ...
            $x--;
            // ...
        }

        if ($c) {
            // ...
        }

        return $x;
    }
}
