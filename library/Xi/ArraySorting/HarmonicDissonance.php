<?php

class HarmonicDissonance
{
    private $anchorDistance;
    private $arrayCount;
    
    public function __construct($arrayToBeHarmonized)
    {
        $this->arrayCount = count($arrayToBeHarmonized);
        $this->anchorDistance = floor($this->arrayCount / 3 * 2) + floor(((floor($this->arrayCount / 4 * 3) - floor($this->arrayCount / 3 * 2)) / 2));
    }
    public function findMaximalHarmonicDistance()
    {
        for (
                $distance = 0;
                $this->anchorDistance + $distance < $this->arrayCount;
                $distance++) {
            
            if(!$this->hasCommonDenominator($this->anchorDistance + $distance)) {
                return $this->anchorDistance + $distance;
            }
            if(!$this->hasCommonDenominator($this->anchorDistance - $distance)) {
                return $this->anchorDistance - $distance;
            }
        }
        echo "No distance could be found\n";
        return 10;
    }
    
    public function hasCommonDenominator($number)
    {
        echo "Finding least common denominator for $this->arrayCount and $number\n";
        for ($commonDenominator = 2; $commonDenominator < $number;$commonDenominator++) {
            if( $this->arrayCount % $commonDenominator == 0 && $number % $commonDenominator == 0 ) {
                echo "Common denominator found : $commonDenominator\n";
                return true;
            }
        }
        return false;
    }
}