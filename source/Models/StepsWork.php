<?php

namespace Source\Models;

use Source\Core\Model;

class StepsWork extends Model
{
    public function __construct()
    {
        parent::__construct(
            "steps_work", ["id_steps_work"], ["steps_work"], "id_steps_work"
        );
    }
}