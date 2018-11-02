<?php


namespace App\Models;


trait Queryable
{
    /**
     * @param $name
     * @param $arguments
     */
    public function __call($name, $arguments)
    {
        die('1231');
        if (method_exists($this, $name)) {
            $connection = $this->getConnection();
            $this->db = $connection->createQueryBuilder();
            $this->$name($arguments);
        }
    }
}