<?php

/**
 * Class Collection
 * @author Joost Mul <eutil@jmul.net>
 */
final class Collection
{
    /**
     * @param array $array
     * @param array $keys
     * @param mixed $default
     *
     * @return mixed
     */
    public function getFromArrayByKeys($array, $keys, $default = null)
    {
        $keys = self::ensureValueIsArray($keys);

        $scope = $array;
        foreach ($keys as $key) {
            if (isset($scope[$key])) {
                $scope = $scope[$key];
            } else {
                return $default;
            }
        }

        return $scope;
    }

    /**
     * @param mixed $value
     * @return array
     */
    public function ensureValueIsArray($value)
    {
        if (!is_array($value)) {
            $value = [$value];
        }

        return $value;
    }
}