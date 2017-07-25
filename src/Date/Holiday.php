<?php

namespace EUtil\Date;

/**
 * Class Holiday
 * @author Joost Mul <eutil@jmul.net>
 */
final class Holiday
{
    /**
     * @param int $year
     * @return int
     */
    public function getEasterSundayTimestampForYear($year) {
        $goldenNumber = $year % 19;

        // Calculate the offset of the gregorian calender.
        $c = $year / 100;
        $gregorian = ($c - ($c / 4) - ((8 * $c + 13) / 25) + 19 * $goldenNumber + 15) % 30;
        $offset = $gregorian - ($gregorian / 28) * (1 - ($gregorian / 28) * (29 / ($gregorian + 1)) * ((21 - $goldenNumber) / 11));
        $day = $offset - (($year + ($year / 4) + $offset + 2 - $c + ($c / 4)) % 7) + 28;
        $month = 3;
        if ($day > 31) {
            $month++;
            $day -= 31;
        }

        return mktime( 0,0,0,$month,$day,$year );
    }

    /**
     * @param int $year
     * @return int
     */
    public function getGoodFridayTimestampForYear($year)
    {
        $easter = $this->getEasterSundayTimestampForYear($year);
        return strtotime('-2 days', strtotime($easter));
    }

    /**
     * @param int $year
     * @return int
     */
    public function getPentecostTimestampForYear($year)
    {
        $easter = $this->getEasterSundayTimestampForYear($year);
        return strtotime('+49 days', strtotime($easter));
    }

    /**
     * @param int $year
     * @return int
     */
    public function getFeastOfAscensionTimestampForYear($year)
    {
        $pentecost = $this->getPentecostTimestampForYear($year);
        return strtotime('-10 days', strtotime($pentecost));
    }

    /**
     * @param int $year
     * @return int
     */
    public function getNewYearsDayTimestampForYear($year)
    {
        return strtotime(date("{$year}-01-01"));
    }

    /**
     * @param int $year
     * @return int
     */
    public function getXmasDayTimestampForYear($year)
    {
        return strtotime(date("{$year}-12-25"));
    }

    /**
     * @param int $year
     * @return int
     */
    public function getBoxingDayTimestampForYear($year)
    {
        return strtotime(date("{$year}-12-26"));
    }
}