<?php

namespace EUtil\Helper;

/**
 * Class Http
 * @author Joost Mul <eutil@jmul.net>
 */
final class Http
{
    /**
     * @param string $url
     * @return string
     */
    public function getPageContentForUrl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}