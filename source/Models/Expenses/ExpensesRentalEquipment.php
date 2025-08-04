<?php

namespace Source\Models\Expenses;

use Source\Core\Model;

class ExpensesRentalEquipment extends Model
{
    public function __construct()
    {
        parent::__construct(
            "expenses_rental_equipment", 
            ["id_expenses_rental_equipment"], 
            ["id_work", "id_steps_work"], 
            "id_expenses_rental_equipment"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idWork,
        int $idStepsWork,
        int $idCostsRentalEquipment,
        string $dateStart,
        string $dateEnd,
        $valueDaily,
        string $detailEquipment,
        string $budget
    ) : ExpensesRentalEquipment {
        $this->id_user_system_register = $idUserSystem;
        $this->id_work = $idWork;
        $this->id_steps_work = $idStepsWork;
        $this->id_costs_rental_equipment = $idCostsRentalEquipment;
        $this->date_start = $dateStart;
        $this->date_end = $dateEnd;
        $this->value_daily = $valueDaily;
        $this->detail_equipment = $detailEquipment;
        $this->budget = $budget;
        return $this;
    }
}