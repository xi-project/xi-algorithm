<?php

namespace Xi\Algorithm;

class Luhn
{
    /**
     * @var integer
     */
    private $number;

    /**
     * @param integer $number
     */
    public function __construct($number)
    {
        $this->number = $number;
    }

    /**
     * Returns the given number with luhn algorithm applied.
     *
     * For example 456 becomes 4564.
     *
     * @return integer
     */
    public function generate()
    {
        $stack = 0;
        $number = str_split(strrev($this->number), 1);

        foreach ($number as $key => $value) {
            if ($key % 2 === 0) {
                $value = array_sum(str_split($value * 2, 1));
            }

            $stack += $value;
        }

        $stack %= 10;

        if ($stack !== 0) {
            $stack -= 10;
        }

        return (int) (implode('', array_reverse($number)) . abs($stack));
    }
}
