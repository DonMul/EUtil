<?php

namespace EUtil\Exception\Database;

use Exception;

/**
 * Class InvalidParametersException
 * @author Joost Mul <eutils@jmul.net>
 */
class InvalidParametersException extends Exception
{
    /**
     * InvalidParametersException constructor.
     */
    public function __construct()
    {
        parent::__construct("Given parameter amount does not match the types");
    }
}