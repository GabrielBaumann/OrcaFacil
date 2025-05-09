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

    public function bootstrap(
        int $idUser,
        string $name_recipient,
        string $cpf,
        string $address,
        string $contact,
        string $email,
        string $gender,
        string $observation,
        string $date_birth,
        string $startdate,
        string $city,
        string $estate,
        int $active = 1,
        
    ) : RecipientWork {
        $this->id_user = $idUser;
        $this->name_recipient = $name_recipient;
        $this->cpf = $cpf;
        $this->address = $address;
        $this->contact = $contact;
        $this->email = $email;
        $this->gender = $gender;
        $this->observation = $observation;
        $this->date_birth = $date_birth;
        $this->startdate = $startdate;
        $this->city = $city;
        $this->estate = $estate;
        $this->active = $active;
        return $this;
    }

}