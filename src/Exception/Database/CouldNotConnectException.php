<?php

namespace EUtil\Exception\Database;

use Exception;

/**
 * Class CouldNotConnectException
 * @author Joost Mul <eutils@jmul.net>
 */
class CouldNotConnectException extends Exception
{
    /**
     * CouldNotConnectException constructor.
     * @param string $location
     */
    public function __construct($location)
    {
        parent::__construct("Could not connect to database on {$location}");
    }
}