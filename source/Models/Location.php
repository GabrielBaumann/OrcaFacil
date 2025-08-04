<?php

namespace Source\Models;

use Source\Core\Model;

class Location extends Model
{
    public function __construct()
    {
        parent::__construct(
            "location_address", ["id_location_address"], [], "id_location_address"
        );
    }
}