<?php

namespace Source\Models;

use Source\Core\Model;

class Work extends Model
{
    public function __construct()
    {
        parent::__construct(
            "work_client", ["id_work"], ["id_client", "name_work"], "id_work"
        );
    }

    public function bootstrap(
        int $idUserSystem,
        int $idClient,
        string $nameWork,
        string $addressWork,
        string $typeWork,
        string $locationWork,
        string $dateStart,
        string $dateEnd,
        string $detailWork,
        $statusWork
    ) : Work {
        $this->id_user_system_register = $idUserSystem;
        $this->id_client = $idClient;
        $this->name_work = $nameWork;
        $this->type_work = $typeWork;
        $this->address_work = $addressWork;
        $this->id_location_work = $locationWork;
        $this->date_start = $dateStart;
        $this->date_end_forcast = $dateEnd;
        $this->detail_work = $detailWork;
        $this->status = $statusWork;
        return $this;
    }

    // Mudar status da obra
    public function fncStatusWorks($idStatus, $idWork) : void
    {
        // Status da obra
        // Em andamento = 1
        // Finalizada = 2
        // Cancelada = 3

        $status = "";
        switch ($idStatus) {
            case 1:
                $status = "EM ANDAMENTO";
                break;
            case 2:
                $status = "FINALIZADA";
                break;
            case 3:
                $status = "CANCELADA";
                break;
            default:
                $status = "CADASTRADA";
        }

        $workClient = new static()->findById($idWork);
        $workClient->status = $status;
        $workClient->save(); 
    }

}