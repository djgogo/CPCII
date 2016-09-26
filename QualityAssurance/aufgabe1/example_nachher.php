<?php
for ($i = 0; $i < count($ItemList); ++$i) {
    if ($i % 2 == 0) {
        if ($th < $ItemList[$i]->value) { /* ... */
        } else if ($th == $ItemList[$i]->value) { /* ... */
        } elseif ($th > $ItemList[$i]->value) {
            if ($highlight_value == c_green) {
                $c = '#00ff00';
            } elseif ($highlight_value == c_red) {
                $c = '#ff0000';
            } elseif ($highlight_value == c_blue) {
                $c = '#0000ff';
            }
        } else {
            $c = '#000000';
        }
    }
    echo $c;
}

