<?php

namespace EUtil\Validate;

/**
 * Class Number
 * @author Joost Mul <eutil@jmul.net>
 */
final class Number
{
    /**
     * @param int $value
     * @return bool
     */
    public function isNumeric($value)
    {
        return is_numeric($value);
    }

    /**
     * @param int  $value
     * @param bool $includeZero
     * @return bool
     */
    public function isPositive($value, $includeZero = false)
    {
        return (
            $value > 0 ||
            ($includeZero === true && $value == 0)
        ) && $this->isNumeric($value);
    }

    /**
     * @param int  $value
     * @param bool $includeZero
     * @return bool
     */
    public function isNegative($value, $includeZero = false)
    {
        return (
            $value < 0 ||
            ($includeZero === true && $value == 0)
        ) && $this->isNumeric($value);
    }

    /**
     * @param int  $value
     * @param int  $largerThanNumber
     * @return bool
     */
    public function isLargerThan($value, $largerThanNumber)
    {
        return $value > $largerThanNumber && $this->isNumeric($value);
    }

    /**
     * @param int  $value
     * @param int  $smallerThanNumber
     * @return bool
     */
    public function isSmallerThan($value, $smallerThanNumber)
    {
        return $value < $smallerThanNumber && $this->isNumeric($value);
    }
}