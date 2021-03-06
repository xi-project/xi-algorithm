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
        $luhn = new Luhn();
        $luhnedNumber = $luhn->generate($number);

        $this->assertInternalType('integer', $luhnedNumber);
        $this->assertEquals($expected, $luhnedNumber);
    }

    /**
     * @return array
     */
    public function luhnProvider()
    {
        return array(
            array(79927398, 799273982),
            array(123, 1230),
            array(456, 4564),
        );
    }

    /**
     * @test
     * @dataProvider luhnValidProvider
     *
     * @param integer $number
     * @param integer $expected
     */
    public function validatesLuhnChecksum($number)
    {
        $luhn = new Luhn();

        $this->assertTrue($luhn->validate($number));
    }


    /**
     * @return array
     */
    public function luhnValidProvider()
    {
        return array(
            array(799273982),
            array(1230),
            array(4564),
        );
    }

    /**
     * @test
     * @dataProvider luhnInvalidProvider
     *
     * @param integer $number
     * @param integer $expected
     */
    public function validatesInvalidLuhnChecksum($number)
    {
        $luhn = new Luhn();

        $this->assertFalse($luhn->validate($number));
    }


    /**
     * @return array
     */
    public function luhnInvalidProvider()
    {
        return array(
            array(799273983),
            array(1231),
            array(4565),
            array(1),
        );
    }
}
