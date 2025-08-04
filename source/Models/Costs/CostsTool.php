<?php

namespace Source\Models\Costs;

use Source\Core\Model;

class CostsTool extends Model
{
    public function __construct()
    {
        parent::__construct(
            "costs_tool", ["id_costs_tool"], ["name_tool"], "id_costs_tool"
        );
    }
}