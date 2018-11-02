<?php


namespace App\Models;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;
use Doctrine\DBAL\Query\QueryBuilder;

class Model
{

    /**
     * @var QueryBuilder
     */
    protected $db;
    /**
     * @var Configuration
     */
    protected $config;
    /**
     * @var array
     */
    protected $connectionParams;
    /**
     * @var string
     */
    protected $table;

    /**
     * Model constructor.
     */
    public function __construct()
    {
        if(empty($this->table)) {
            $this->table = strtolower(get_class($this));
        }

        $this->config = new Configuration();
        $this->connectionParams = array(
            'dbname' => 'testdb',
            'user' => 'root',
            'password' => 'root',
            'host' => 'localhost',
            'driver' => 'pdo_mysql',
        );
    }

    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        $actualMethod = '_'.$name;
        $connection = $this->getConnection();
        $this->db = $connection->createQueryBuilder();
        $this->$actualMethod($arguments);
    }

    /**
     * @return \Doctrine\DBAL\Connection
     * @throws \Doctrine\DBAL\DBALException
     */
    protected function getConnection()
    {
        return DriverManager::getConnection($this->connectionParams, $this->config);
    }

}