<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwGeneralExpensesPriceTotal extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_general_expenses_price_total", ["id_work"], ["expenses_work_total"], "id_work"
        );
    }
}