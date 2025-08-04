<?php

namespace Source\Models\Views;

use Source\Core\Model;

class VwPainelWork extends Model
{
    public function __construct()
    {
        parent::__construct(
            "vw_painel_works", ["id_work"], ["name_work"], "id_work"
        );
    }
}