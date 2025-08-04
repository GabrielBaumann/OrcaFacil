<?php

namespace Source\Models\Costs;

use Source\Core\Model;

class CostsAdministrative extends Model
{
    public function __construct()
    {
        parent::__construct(
            "costs_administrative", ["id_costs_administrative"], ["name_administrative"], "id_costs_administrative"
        );
    }
}