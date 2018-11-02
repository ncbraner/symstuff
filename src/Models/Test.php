<?php


namespace App\Models;


class Test extends Model
{

    public function _getByName($name)
    {
        $query = $this->db->select('*')
            ->from($this->table)
            ->where('name = :name')
            ->setParameter('name', $name);
        return $query->execute()->fetchAll();
    }
}