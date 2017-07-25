<?php

namespace EUtil\Validate;

/**
 * Class Text
 * @author Joost Mul <eutils@jmul.net>
 */
final class Text
{
    /**
     * @param string $text
     * @param int    $minLength
     * @return bool
     */
    public function isLongerThan($text, $minLength)
    {
        return strlen($text) > $minLength;
    }

    /**
     * @param string $text
     * @param int    $maxLength
     * @return bool
     */
    public function isShorterThan($text, $maxLength)
    {
        return strlen($text) < $maxLength;
    }
}