<?php

namespace EUtil\Validate;

/**
 * Class IpAddress
 * @author Joost Mul <eutil@jmul.net>
 */
final class IpAddress
{
    /**
     * @param string $address
     * @return bool
     */
    public function isValidIPv4($address)
    {
        return preg_match('/^([0-9]{1,3}\.){3}[0-9]{1,3}/', $address) === 1;
    }

    /**
     * @param string $address
     * @return bool
     */
    public function isValidIPv6($address)
    {
        return filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === $address;
    }
}