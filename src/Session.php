<?php

namespace EUtil;

use EUtil\Helper\Collection;

/**
 * Class Session
 * @author Joost Mul <eutil@jmul.net>
 */
class Session
{
    /**
     * @var Collection
     */
    private $collectionHelper;

    /**
     * Session constructor.
     */
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $this->collectionHelper = new Collection();
    }

    /**
     * @param string|string[]   $name
     * @param mixed             $value
     */
    public function setVariable($name, $value)
    {
        $_SESSION = $this->collectionHelper->setArrayValueByKeys($_SESSION, $name, $value);
    }

    /**
     * @param string|string[]   $name
     * @param mixed             $default
     * @return mixed
     */
    public function getVariable($name, $default = null)
    {
        return $this->collectionHelper->getFromArrayByKeys($_SESSION, $name, $default);
    }

    /**
     * @param string|string[] $name
     * @return bool
     */
    public function hasVariable($name)
    {
        return $this->collectionHelper->issetInArray($_SERVER, $name);
    }
}