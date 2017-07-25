<?php

namespace EUtil\Database;

use EUtil\Exception\Database\CouldNotConnectException;
use EUtil\Exception\Database\GeneralException;
use EUtil\Exception\Database\InvalidParametersException;

/**
 * Class Database
 * @package Database
 * @author Joost Mul <scraper@jmul.net>
 */
final class MySQL
{
    /**
     * THe underlying MySQL database connection
     *
     * @var \mysqli
     */
    private $connection;

    /**
     * Whether or not the connection should have been initiated
     * @var bool
     */
    private $connectionLoaded = false;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $host;

    /**
     * MySQL constructor.
     * @param string $username
     * @param string $password
     * @param string $database
     * @param string $host
     */
    public function __construct($username, $password, $database, $host)
    {
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
        $this->host = $host;
    }

    /**
     * Executes the given query and returns the mysql_result of it. Bind the given params to the query's
     * prepared statement
     *
     * @param  string $query
     * @param  array  $params
     * @param  string $types
     * @return \mysqli_stmt
     * @throws InvalidParametersException
     * @throws GeneralException
     */
    public function query($query, $params = [], $types = '')
    {
        if (count($params) !== strlen($types)) {
            throw new InvalidParametersException();
        }

        $this->ensureConnection();

        $stmt = $this->connection->prepare($query);
        if (!empty($params)) {
            $args = [];
            array_unshift($params, $types);
            $count = count($params);

            for ($i = 0; $i < $count; $i++) {
                $args[$i] = & $params[$i];
            }

            if (!$stmt) {
                throw new GeneralException($this->connection->error, $this->connection->errno);
            }
            call_user_func_array([$stmt, 'bind_param'], $args);
        }

        if (!$stmt) {
            throw new GeneralException($this->connection->error, $this->connection->errno);
        }

        $stmt->execute();
        if (!$stmt) {
            throw new GeneralException($stmt->error, $stmt->errno);
        }

        return $stmt;
    }

    /**
     * Returns the first row of the given query's result set.
     *
     * @param string $query
     * @param array  $params
     * @param string $types
     * @return mixed
     */
    public function fetchOne($query, $params = [], $types = '')
    {
        $result = $this->query($query, $params, $types);
        $result = $result->get_result();
        $return = null;

        while ($row = $result->fetch_assoc()) {
            $return = $row;
            break;
        }

        return $return;
    }

    /**
     * Returns the first row of the given query's result set.
     *
     * @param string $query
     * @param string $colName
     * @param array  $params
     * @param string $types
     * @return mixed
     */
    public function fetchCol($query, $colName, $params = [], $types = '')
    {
        $result = $this->fetchOne($query, $params, $types);
        return (new \EUtil\Collection())->getFromArrayByKeys($result, [$colName]);
    }

    /**
     * Change the database connection to make use of another database with the given name
     *
     * @param string $databaseName
     */
    public function changeDatabase($databaseName)
    {
        $this->ensureConnection();
        $this->connection->select_db($databaseName);
    }

    /**
     * Executes the query and returns its result set as an array with associative arrays
     *
     * @param string $query
     * @param array  $params
     * @param string $types
     * @return mixed
     */
    public function fetchAll($query, $params = [], $types = '')
    {
        $result = $this->query($query, $params, $types);
        $result = $result->get_result();
        $return = [];
        while ($row = $result->fetch_assoc()) {
            $return[] = $row;
        }

        return $return;
    }

    /**
     * Makes sure the connection is made with the database.
     *
     * @throws \Exception
     */
    protected function ensureConnection()
    {
        if (!$this->connectionLoaded) {
            $this->connection = mysqli_connect(
                $this->host,
                $this->username,
                $this->password,
                $this->database
            );

            if (!$this->connection) {
                throw new CouldNotConnectException($this->username);
            }

            $this->connectionLoaded = true;
        }
    }
}
