<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwStatusWork extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_status_works", ["total_work"], ["status"], "total_work"
        );
    }
}