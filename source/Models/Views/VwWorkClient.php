<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwWorkClient extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_work_client", ["id_work"], ["name_client"], "id_work"
        );
    }
}