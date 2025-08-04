<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwGeneralExpenses extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_general_expenses", ["id_type_category"], ["name_work"], "id_type_category"
        );
    }
}