<?php

# Pizza Model
namespace Model;

use Core\Model;

class PizzaModel extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function pizzaList()
    {
        return $this->db->select('select * from ' . PIZZA_TAB);
    }

    public function create($data, $types)
    {
        $this->db->insertTypes(PIZZA_TAB, $data, $types);
    }

    public function change($data)
    {
        $this->db->update(PIZZA_TAB, $data, "`id` = {$data['id']}");
    }

    public function delete($pizza)
    {
        $this->db->delete(PIZZA_TAB, "`id` = $pizza");
    }

    public function selectOne($column, $id)
    {
        return $this->db->select('select ' . $column . ' from ' . PIZZA_TAB . ' where id = ' . $id);
    }

    public function changeBLOB($data, $types)
    {
        $this->db->changeBLOB(PIZZA_TAB, $data, $types, "`id` = {$data['id']}");
    }
}