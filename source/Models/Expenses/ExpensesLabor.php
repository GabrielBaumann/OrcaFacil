<?php

namespace Source\Models\Expenses;

use Source\Core\Model;

class ExpensesLabor extends Model
{
    public function __construct()
    {
        parent::__construct(
            "expenses_labor", 
            ["id_expenses_labor"], 
            ["id_costs_labor"], 
            "id_expenses_labor"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idWork,
        int $idStepsWork,
        int $idCostsLabor,
        string $nameEmployee,
        string $formatLabor,
        $daysWorked,
        $valueDaily,
        $contractValue,
        string $detailExpenseLabor,
        string $budget
    ) : ExpensesLabor {
        $this->id_user_system_register = $idUserSystem;
        $this->id_work = $idWork;
        $this->id_steps_work = $idStepsWork;
        $this->id_costs_labor = $idCostsLabor;
        $this->name_employee = $nameEmployee;
        $this->format_work = $formatLabor;
        $this->days_worked = $daysWorked;
        $this->value_daily = $valueDaily;
        $this->contract_value = $contractValue;
        $this->detail_expenses_labor = $detailExpenseLabor;
        $this->budget = $budget;
        return $this;
    }
}