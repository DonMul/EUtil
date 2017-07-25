<?php

namespace Exception\Database;

use Exception;

/**
 * Class GeneralException
 * @author Joost Mul <eutils@jmul.net>
 */
class GeneralException extends Exception
{
    /**
     * GeneralException constructor.
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code)
    {
        parent::__construct($message, $code);
    }
}