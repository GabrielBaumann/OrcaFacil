<?php

namespace Source\Models\Expenses;

use Source\Core\Model;

class ExpensesAdministrative extends Model
{
    public function __construct()
    {
        parent::__construct(
            "expenses_administrative", 
            ["id_expenses_administrative"], 
            ["id_costs_administrative"], 
            "id_expenses_administrative"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idWork,
        int $idStepsWork,
        int $idCostsAdministrative,
        $priceAdministrative,
        string $detailAdministrative,
        string $budget
    ) : ExpensesAdministrative {
        $this->id_user_system_register = $idUserSystem;
        $this->id_work = $idWork;
        $this->id_steps_work = $idStepsWork;
        $this->id_costs_administrative = $idCostsAdministrative;
        $this->value_administrative = $priceAdministrative;
        $this->detail_administrative = $detailAdministrative;
        $this->budget = $budget;
        return $this;
    }
}