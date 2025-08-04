<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwExpensesStepsPrice extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_expenses_steps_price", ["steps_work"], ["total_expenses"], "steps_work"
        );
    }
}