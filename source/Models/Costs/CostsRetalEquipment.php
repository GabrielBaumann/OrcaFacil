<?php

namespace Source\Models\Costs;

use Source\Core\Model;

class CostsRetalEquipment extends Model
{
    public function __construct()
    {
        parent::__construct(
            "costs_rental_equipment", 
            ["id_costs_rental_equipment"], 
            ["name_equipment"], 
            "id_costs_rental_equipment"
        );
    }
}