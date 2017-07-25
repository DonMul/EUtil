<?php

namespace EUtil\Helper;

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
        $keys = $this->ensureValueIsArray($keys);

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

    /**
     * @param array $array
     * @param array $keys
     * @param mixed $value
     *
     * @return array
     */
    public function setArrayValueByKeys($array, $keys, $value)
    {
        $keys = $this->ensureValueIsArray($keys);
        $array = $this->ensureValueIsArray($array);

        $arrayCopy = $array;
        $scope = &$arrayCopy;
        $size = count($keys);
        $i = 0;

        foreach ($keys as $key) {
            $i++;

            if ($i == $size) {
                $scope[$key] = $value;
            } else {
                if (!isset($scope[$key])) {
                    $scope[$key] = [];
                } else {
                    $scope[$key] = $this->ensureValueIsArray($scope[$key]);
                }

                $scope = &$scope[$key];
            }
        }
        return $arrayCopy;
    }

    /**
     * @param array $array
     * @param array $keys
     *
     * @return bool
     */
    public function issetInArray($array, $keys)
    {
        $keys = $this->ensureValueIsArray($keys);
        $scope = $array;
        foreach ($keys as $key) {
            if (isset($scope[$key])) {
                $scope = $scope[$key];
            } else {
                return false;
            }
        }

        return true;
    }
}