<?php

namespace Xi\Tests\Algorithm;

use Xi\Algorithm\Luhn;

/**
 * @group tool
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
        $luhnedNumber = (new Luhn($number))->generate();

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
