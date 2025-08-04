<?php

namespace Source\Models\Costs;

use Source\Core\Model;

class CostsLabor extends Model
{
    public function __construct()
    {
        parent::__construct(
            "costs_labor", ["id_costs_labor"], ["name_labor"], "id_costs_labor"
        );
    }
}