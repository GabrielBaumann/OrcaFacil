<?php

namespace Source\Models\Expenses;

use Source\Core\Model;

class ExpensesMaterial extends Model
{
    public function __construct()
    {
        parent::__construct(
            "expenses_material", 
            ["id_expenses_material"], 
            ["id_work", "id_steps_work"], 
            "id_expenses_material"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idWork,
        int $idStepsWork,
        int $idCostsMaterial,
        int $unit,
        $amount,
        $princeUnit,
        string $detailExpenseMaterial,
        string $budget
    ) : ExpensesMaterial {
        $this->id_user_system_register = $idUserSystem;
        $this->id_work = $idWork;
        $this->id_steps_work = $idStepsWork;
        $this->id_costs_material = $idCostsMaterial;
        $this->unit = $unit;
        $this->amount = $amount;
        $this->price_unit = $princeUnit;
        $this->detail_expense_material = $detailExpenseMaterial;
        $this->budget = $budget;
        return $this;
    }
}