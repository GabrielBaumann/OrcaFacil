<?php

namespace Source\Models;

use Source\Core\Model;

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
}