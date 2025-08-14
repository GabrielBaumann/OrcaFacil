<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Client;
use Source\Models\Location;

class AppClient extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        // if (!$this->user = Auth::user()) {
        //     $this->message->warning("Efetue login para acessar o sistema.")->flash();
        //     redirect("/");
        // }

    }
    
    public function pageClient() : void
    {
        echo $this->view->render("client", [
            "title" => "OrçaFácil - Clientes",
            "usuario" => Auth::user()->nome ?? null,
            "typeAccess" => Auth::user()->type_access ?? null,
            "listClient" => new Client()->find()->fetch(true)
        ]);
    }

    public function addClient(?array $data) : void
    {   
        // Decriptar dados
        if(isset($data["idclient"]) && !empty($data["idclient"])) {
            $idClient = (int)decrypt_data($data["idclient"]);
        }

        // Confirmar exclusão do cliente
        if(($data["btn-form"] ?? null)  === "delete") {

            $html = $this->view->render("/client/modalYesNoDelete", [
                "idclient" => $data["idclient"],
                "idexpenses" => null,
                "budget" => null,
                "idwork" => null
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        if(!empty($data["csrf"])) {

            $dataSanitize = cleanInputData($data, ["email"]);

            if(!$dataSanitize["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $dataSanitize["data"];

            $client = new Client();
            $client->bootstrap(
                1,
                $dataClean["name-client"],
                $dataClean["cpf"],
                $dataClean["telephone"],
                $dataClean["email"],
                $dataClean["address"],
                $dataClean["gender-client"],
                $dataClean["location-client"]
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($idClient) && !empty($idClient)) {
                $client->id_client = $idClient;
                $client->id_user_system_update = 1;
            }

            $client->save();

            if(isset($idClient) && !empty($idClient)) {
                $json["message"] = $client->message()->render();
                echo json_encode($json);
                return;
            }

            $idClientCreat = $client->id_client;

            // Chama o modal para cadastrar obra

            $html = $this->view->render("/client/modalYesNo", [
                "idClient" => $idClientCreat ?? null
            ]);

            $json["html"] = $html;
            $json["message"] = $client->message()->render();
            echo json_encode($json);
            return;
        }


        $defaultForms = [
            "title" => "OrçaFácil - Cadastro Clientes",
            "url" => url("/clientes"),
            "titleForms" => "Novo Cliente",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo cliente",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/client/formClient", [
            "default" => $defaultFormsObj,
            "locationAddress" => (new Location())->find()->order("location")->fetch(true),
            "editClient" => (new Client())->findById($idClient ?? 0)
        ]);
    }

    public function deleteConfirmClient($data): void
    {
        $idclient = (int)decrypt_data($data["idclient"]);
        $client = new Client();
        $deleteClient = $client->findById($idclient);

        if(!$deleteClient->destroy()) {
            $json["message"] = messageHelpers()->warning("Erro ao excluir!Atualize a página e tente novamente.")->render();
            echo json_encode($json);        
            return;
        }

        $json["messge"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
        $json["redirect"] = url("/clientes");
        echo json_encode($json);
        return;
    }
}