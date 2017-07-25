<?php

namespace EUtil\Date;

/**
 * Class Season
 * @author Joost Mul <eutil@jmul.net>
 */
final class Season
{
    const SEASON_SPRING = 'spring';
    const SEASON_SUMMER = 'summer';
    const SEASON_FALL = 'fall';
    const SEASON_WINTER = 'winter';

    /**
     * @param int $timestamp
     * @return string
     */
    public function getSeasonForTimestamp($timestamp = null)
    {
        if ($timestamp == null) {
            $timestamp = time();
        }

        $springTimestamp = strtotime(date('Y-04-20', $timestamp));
        $summerTimestamp = strtotime(date('Y-06-20', $timestamp));
        $fallTimestamp = strtotime(date('Y-09-22', $timestamp));
        $winterTimestamp = strtotime(date('Y-12-21', $timestamp));

        if ($timestamp >= $springTimestamp && $timestamp < $summerTimestamp) {
            return self::SEASON_SPRING;
        } else if ($timestamp >= $summerTimestamp && $timestamp < $fallTimestamp) {
            return self::SEASON_SUMMER;
        } else if ($timestamp >= $fallTimestamp && $timestamp < $winterTimestamp) {
            return self::SEASON_FALL;
        } else {
            return self::SEASON_WINTER;
        }
    }
}