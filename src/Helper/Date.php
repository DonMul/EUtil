<?php

namespace EUtil\Helper;

/**
 * Class Date
 * @author Joost Mul <eutil@jmul.net>
 */
final class Date
{
    /**
     * @param int  $timestamp
     * @param bool $shouldStartOnMonday
     * @return int
     */
    public function getBeginOfWeekForTimestamp($timestamp, $shouldStartOnMonday = true)
    {
        if ($shouldStartOnMonday === true) {
            $newTimestamp = strtotime('monday this week', $timestamp);
        } else {
            $newTimestamp = strtotime('sunday this week', $timestamp);
        }

        return strtotime(date('Y-m-d', $newTimestamp));
    }

    /**
     * @param int  $timestamp
     * @param bool $shouldStartOnMonday
     * @return int
     */
    public function getEndOfWeekForTimestamp($timestamp, $shouldStartOnMonday = true)
    {
        if ($shouldStartOnMonday === true) {
            $newTimestamp = strtotime('sunday this week', $timestamp);
        } else {
            $newTimestamp = strtotime('saturday this week', $timestamp);
        }

        return strtotime(date('Y-m-d', $newTimestamp));
    }
}