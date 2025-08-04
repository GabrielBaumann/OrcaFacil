<?php

namespace Source\Models;

use Source\Core\Model;

class Client extends Model
{
    public function __construct()
    {
        parent::__construct(
            "client", ["id_client"], ["name_client"], "id_client"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        string $nameClient,
        string $cpfClient,
        string $contactClient,
        string $emailClient,
        string $addressClient,
        string $genderClient,
        int $locationClient
    ) : Client {
        $this->id_user_system_register = $idUserSystem;
        $this->name_client = $nameClient;
        $this->cpf_client = $cpfClient;
        $this->contact_client = $contactClient;
        $this->email_client = $emailClient;
        $this->address_client = $addressClient;
        $this->gender = $genderClient;
        $this->id_location_client = $locationClient;
        return $this;
    }
}