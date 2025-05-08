<?php

namespace Source\Models;

use Source\Core\Model;

class RecipientWork extends Model
{
    public function __construct()
    {
        parent::__construct(
            "recipient_work",
            ["id_work_recipient"],
            ["id_user", "name_recipient"],
            "id_work_recipient"
        );
    }
}