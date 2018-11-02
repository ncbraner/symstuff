<?php


namespace App\Models;


class Test extends Model
{

    public function getByName($name)
    {
        $query = $this->db->select('*')
            ->from('test');
        return $query->execute()->fetchAll();
    }
}