<?php

namespace Source\Models;

use Source\Core\Model;
use Source\Models\Auth;
class MaterialWork extends Model
{
    public function __construct()
    {
        parent::__construct(
            "material_work",
            ["id_material_work"],
            ["material", "unit_price", "amount", "total_value"],
            "id_material_work"
        );
    }

    public function totalSpent(int $idWorker) 
    {
        $total = $this->find("id_work = :id", "id={$idWorker}", "(SELECT SUM(total_value)) AS total")->fetch(true);
        return (object) $total[0]; 
    }

}