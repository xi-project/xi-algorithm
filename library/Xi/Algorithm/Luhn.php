<?php

namespace Xi\Algorithm;

class Luhn
{
    /**
     * Returns the given number with luhn algorithm applied.
     *
     * For example 456 becomes 4564.
     *
     * @param  integer $number
     * @return integer
     */
    public function generate($number)
    {
        $stack = 0;
        $numbers = str_split(strrev($number), 1);

        foreach ($numbers as $key => $value) {
            if ($key % 2 === 0) {
                $value = array_sum(str_split($value * 2, 1));
            }

            $stack += $value;
        }

        $stack %= 10;

        if ($stack !== 0) {
            $stack -= 10;
        }

        return (int) (implode('', array_reverse($numbers)) . abs($stack));
    }
}
