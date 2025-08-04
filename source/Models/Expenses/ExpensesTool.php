<?php

namespace Source\Models\Expenses;

use Source\Core\Model;

class ExpensesTool extends Model
{
    public function __construct()
    {
        parent::__construct(
            "expenses_tool", 
            ["id_expenses_tool"], 
            ["id_costs_tool"], 
            "id_expenses_tool"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idWork,
        int $idStepsWork,
        int $idCostsTool,
        int $unitTool,
        $amountTool,
        $valueUnitaryTool,
        string $detailToo,
        string $budget
    ) : ExpensesTool {
        $this->id_user_system_register = $idUserSystem;
        $this->id_work = $idWork;
        $this->id_steps_work = $idStepsWork;
        $this->id_costs_tool = $idCostsTool;
        $this->unit_tool = $unitTool;
        $this->amount_tool = $amountTool;
        $this->value_unitary_tool = $valueUnitaryTool;
        $this->detail_too = $detailToo;
        $this->budget = $budget;
        return $this;
    }
}