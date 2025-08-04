<?php

namespace Source\Models\Costs;

use Source\Core\Model;

class CostsMaterial extends Model
{
    public function __construct()
    {
        parent::__construct(
            "costs_material", ["id_costs_material"], ["name_material"], "id_costs_material"
        );
    }
}