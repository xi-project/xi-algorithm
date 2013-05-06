<?php
namespace Xi\Algorithm;

class TopologicalSortTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function simpleCase()
    {
        $edges = array(
            'B' => array('C', 'D'),
            'A' => array('B'),
            'C' => array('D'),
        );

        for ($i = 0; $i < 100; ++$i) {
            $edges = self::shuffleGraphSpec($edges);
            $this->assertEquals(array('D', 'C', 'B', 'A'), TopologicalSort::apply($edges));
        }
    }

    /**
     * @test
     * @dataProvider provider
     */
    public function test(array $edges)
    {
        for ($i = 0; $i < 100; ++$i) {
            $edges = self::shuffleGraphSpec($edges);
            $sorted = TopologicalSort::apply($edges);
            $this->verify($sorted, $edges);
        }
    }

    public function provider()
    {
        return array(
            array(array(
                'B' => array('C', 'D'),
                'A' => array('B'),
                'C' => array('D'),
            )),

            // Wikipedia's example
            array(array(
                7 => array(11, 8),
                5 => array(11),
                3 => array(8, 10),
                11 => array(2, 9, 10),
                8 => array(9)
            ))
        );
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function throwsOnCycle()
    {
        $edges = array(
            'B' => array('C', 'D'),
            'A' => array('B'),
            'C' => array('D'),
            'D' => array('A')
        );

        TopologicalSort::apply($edges);
    }

    private function shuffleGraphSpec(array $array)
    {
        $keys = array_keys($array);
        shuffle($keys);
        $result = array();
        foreach ($keys as $key) {
            $result[$key] = $array[$key];
            shuffle($result[$key]);
        }

        return $result;
    }

    private function verify(array $sorted, array $edges)
    {
        foreach ($edges as $left => $rights) {
            foreach ($rights as $right) {
                $leftIndex = array_search($left, $sorted);
                $rightIndex = array_search($right, $sorted);
                $this->assertLessThan($leftIndex, $rightIndex);
            }
        }
    }
}
