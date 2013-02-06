<?php

namespace Xi\Algorithm\Tests;

use Xi\Algorithm\Luhn;

/**
 * @group luhn
 */
class LuhnTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider luhnProvider
     *
     * @param integer $number
     * @param integer $expected
     */
    public function generatesLuhnChecksum($number, $expected)
    {
        $luhn = new Luhn($number);
        $luhnedNumber = $luhn->generate();

        $this->assertInternalType('integer', $luhnedNumber);
        $this->assertEquals($expected, $luhnedNumber);
    }

    /**
     * @return array
     */
    public function luhnProvider()
    {
        return [
            [7992739871, 79927398713],
            [123, 1230],
            [456, 4564],
        ];
    }
}
