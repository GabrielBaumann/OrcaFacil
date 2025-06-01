<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;
use Source\Models\MaterialWork;
use Source\Models\RecipientWork;
use Source\Models\Unit;
use Source\Models\User;
use Source\Support\Message;
use Source\Support\Pager;


class App extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/");
        }

    }

    public function recipientWork(?array $data): void
    {
        // Carregar lista baseado na pesquisa do inputSearch
        
        if (isset($data["input-search"]) && !empty($data["input-search"])) {
            $inputSearc = isset($data["input-search"]) && $data["input-search"] ? filter_var($data["input-search"], FILTER_SANITIZE_SPECIAL_CHARS) : null;


            if($inputSearc === "*") {
                $inputSearc = null;
            }
            
            $conditions = [];
            $params = [];

            if (!empty($inputSearc)) {
                $conditions[] = "name_recipient LIKE :n";
                $params["n"] = "%{$inputSearc}%";
            }

            $conditions[] = "id_user = :i";
            $params["i"] = $this->user->id_usuarios;

            $where = implode(" AND ", $conditions);

            $recipentWprk = (new RecipientWork())->find($where, http_build_query($params));
            $pager = new Pager(url("/recipient/p/"));
            $pager->pager($recipentWprk->count(), 10, 1);

            $html = $this->view->render("/updateAjax/listWorksRecipient", [
                "recipients" => $recipentWprk
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("name_recipient")
                    ->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        // Conteúdo das páginas
        if (isset($data["page"]) && $data["page"]) {

            $recipentWprk = (new RecipientWork())->find("id_user = :u", "u={$this->user->id_usuarios}");
            $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
            $pager = new Pager(url("/recipient/p/"));
            $pager->pager($recipentWprk->count(), 10, $page);

            $html = $this->view->render("/updateAjax/listWorksRecipient", [
                "recipients" => $recipentWprk
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("name_recipient")
                    ->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        $recipentWprk = (new RecipientWork())->find("id_user = :u", "u={$this->user->id_usuarios}");
        $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
        $pager = new Pager(url("/recipient/p/"));
        $pager->pager($recipentWprk->count(), 10, $page);
       

        echo $this->view->render("works", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "recipients" => $recipentWprk
                ->limit($pager->limit())
                ->offset($pager->offset())
                ->order("name_recipient")
                ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function addRecipient(?array $data) : void
    {

        if(!empty($data['csrf'])) {

            if(!csrf_verify($data)) {
                $json['message'] = (new Message())->warning("Erro ao enivar, use o formulário!")->render();
                echo json_encode($json);
                return;
            }

            $cleanArray = cleanInputData($data, ["observation","email","telephone"]);

            if(!$cleanArray['valid']) {
                $json["message"] = (new Message())->error("Preencha os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $cleanArray['data'];

            $newRecipientWork = (new RecipientWork());
            $newRecipientWork->bootstrap(
                $this->user->id_usuarios,
                $dataClean["name"],
                $dataClean["cpf"],
                $dataClean["address"],
                $dataClean["gender"],
                $dataClean["date-birth"],
                $dataClean["date-start-work"],
                $dataClean["cit"],
                $dataClean["state"],
                $dataClean["telephone"],
                $dataClean["email"],
                $dataClean["observation"]
            );

            if($newRecipientWork->save()){
                $json["message"] = $this->message->success("Registro salvo com sucesso!")->render();
                $json["complete"] = true;
                echo json_encode($json);
                return;
            }

            $json['message'] = $newRecipientWork->message;
            echo json_encode($json);
            return;
        }
      
        $defaultForms = [
            "title" => "OrçaFácil - Cadastro Obras",
            "url" => url("/recipient"),
            "titleForms" => "Novo Beneficiário",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo eneficiário",
        ];

        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/forms/formRecipient", [
            "default" => $defaultFormsObj
        ]);
        
    }

    public function validateCpf($data) : void
    {

        if(!validateCpf($data["cpf"])) {
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($data['cpf']) . " não é válido inválido!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }

        $recipientWork = (new RecipientWork());
        $recipientWork->find("cpf = :c", "c={$data["cpf"]}");

        if($recipientWork->fetch()) {
            $json["message"] = messageHelpers()->warning("O CPF: " . formatCPF($data['cpf']) . " já existe na base de dados!")->render();
            $json["erro"] = true;
            echo json_encode($json);
            return;
        }
    }

    public function seeDetails(?array $data) : void
    {
        $materialWorks = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}")->order("material")->fetch(true);
        $totalSpent = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}","(SELECT SUM(total_value)) AS total")->fetch();
        $materialCount = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}","(SELECT SUM(amount)) AS totalAmount")->fetch();

        echo $this->view->render("modal/modalViewDetails", [
            "recipient" => (new RecipientWork())->findById($data['idWork']),
            "materialWorks" => $materialWorks,
            "totalSpent" => $totalSpent,
            "materialCount" => $materialCount
        ]);
    }

    public function filterSee(array $data) : void
    {   
        $nameSearch = $data['inputSearch'] ?? null;
        $idRecipient = $data['idRecipient'];

        $nameSearch = ($nameSearch === "*") ? null : $nameSearch;

        $conditions = [];
        $params = [];

        if (!empty($nameSearch)) {
            $conditions[] = "material LIKE :n";
            $params['n'] = "%{$nameSearch}%";
        }

        $conditions[] = "id_work = :w";
        $params['w'] = $idRecipient;

        $where = implode(" AND ", $conditions);

        $materialWorks = (new MaterialWork())->find($where, http_build_query($params))->order("material")->fetch(true);

        $html = $this->view->render("/updateAjax/listViewMaterial", [
            "materialWorks" => $materialWorks
        ]);
        
        $json["html"] = $html;      
        echo json_encode($json); 
    }

    public function registerMaterial(?array $data) : void
    {   

        if (isset($data['idWork'])) {
            $idWork = $data['idWork'];
            $user = (new RecipientWork())->findById($idWork);
        }

        if(!empty($data['csrf'])){

            if(!csrf_verify($data)) {
                $json['message'] = (new Message())->warning("Erro ao enivar, use o formulário!")->render();
                echo json_encode($json);
                return;
            }

            $removerKeys = ["description"];
            $cleanArray = cleanInputData($data, $removerKeys);

            if(!$cleanArray['valid']) {
                $json["message"] = (new Message())->error("Preencha os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $cleanArray['data'];

            $materialWork = new MaterialWork();

            $materialWork->id_user = $this->user->id_usuarios;
            $materialWork->id_work = $dataClean['idWork'];
            $materialWork->material = $dataClean["material"];
            $materialWork->description_material = $data["description"];
            $materialWork->unit = $dataClean["selectAmount"];
            $unit_price = clearCurrency($dataClean["unitPrice"]);
            $amount = floatval($dataClean["amount"]);

            $materialWork->unit_price = $unit_price;
            $materialWork->amount = $amount;
            $materialWork->total_value = $unit_price * $amount;
            
            if($materialWork->save()){

                $materialWorks = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}")->order("material")->fetch(true);
                $totalSpent = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}","(SELECT SUM(total_value)) AS total")->fetch();
                $materialCount = (new MaterialWork())->find("id_work = :id", "id={$data['idWork']}", "(SELECT SUM(amount)) as totalAmount")->fetch();

                $html = $this->view->render("modal/modalViewDetails", [
                    "recipient" => (new RecipientWork())->findById($data['idWork']),
                    "materialWorks" => $materialWorks,
                    "totalSpent" => $totalSpent,
                    "materialCount" => $materialCount
                ]);

                $json["message"] = $this->message->success("Registro salvo com sucesso!")->render();
                $json["complete"] = true;
                $json["html"] = $html;

                echo json_encode($json);
                return;
            }
        }

        echo $this->view->render("modal/modalRegistrationMaterial", [
            "idWork" => $idWork,
            "user" => $user,
            "units" => (new Unit())->find()->order("unit")->fetch(true)
        ]);    
    }

    public function unit() : void
    {   
        echo $this->view->render("unit", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "title" => "Undiade de medida",
            "idUser" => $this->user,
            "typeAccess" => Auth::user()->type_access,
            "units" => (new Unit())->find()
                ->order("unit")
                ->limit(10)
                ->fetch(true)
        ]);    
    }

    public function cadUnit(?array $data) : void
    {

        if(isset($data["idUnit"])) {
            $idUnit = $data["idUnit"];
            $unit = (new Unit())->find("id_unit = :u", "u={$idUnit}")->fetch();
        }

        if(!empty($data["csrf"])) {
            if(!csrf_verify($data)) {
                $json["message"] = messageHelpers()->warning("Erro ao enivar, use o formulário!")->render();
                echo json_encode($json);
                // return;
            }

            $cleanData = cleanInputData($data, ["observation"]);

            if(!$cleanData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            // Dados sanitizados
            $dataCheckd = $cleanData["data"];

            if(!isset($idUnit)){
                // Verificar se a unidade existe e se o nome de abreciação existe
                $unit = (new Unit())->find("unit = :u OR abbreviation = :a", "u={$dataCheckd["unit"]}&a={$dataCheckd["abbreviation"]}");

                if($unit->fetch()) {
                    $json["message"] = messageHelpers()->warning("A unidade já existe na base de dados!")->render();
                    echo json_encode($json);
                    return;
                }
            }

            $complete = true;

            if(isset($idUnit)) {
                $unit->id_user = $idUnit;
                $complete = false;
            }

            $unit->id_user = $this->user->id_usuarios;
            $unit->unit = $dataCheckd["unit"];
            $unit->abbreviation = $dataCheckd["abbreviation"];
            $unit->observation = $dataCheckd["observation"];
            
            if($unit->save()) {
                $json["complete"] = $complete;
                $json["message"] = $unit->message()->render();
                echo json_encode($json);
                return;
            }
        }
        
        $defaultForms = [
            "title" => "OrçaFácil - Cadastro Unidade",
            "url" => url("/unit"),
            "titleForms" => "Nova Unidade",
            "textForms" => "Preencha os dados abaixo para cadastrar uma nova unidade",
        ];

        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/forms/formUnit", [
            "default" => $defaultFormsObj,
            "unit" => $unit ?? null
        ]);    
    }

    public function filterUnit(array $data) : void
    {
        $nameSearch = $data["inputSearch"];

        $condition = [];
        $params = [];

        if (!empty($nameSearch)) {
            $condition[] = "unit LIKE :u";
            $params["u"] = "%{$nameSearch}%";
        }

        $where = implode(" AND ", $condition);

        $html = $this->view->render("/updateAjax/listUnit", [
            "units" => (new Unit())
                ->find($where, http_build_query($params))
                ->order("unit")
                ->limit(10)
                ->fetch(true)
        ]);    

        $json["html"] = $html;
        echo json_encode($json);

    }

    public function deleteUnit(array $data) : void
    {
        if(isset($data["idUnitDelete"])) {
            $idUnitDelete = $data["idUnitDelete"];

            $unitMaterialwork = (new MaterialWork())->find("unit = :id", "id={$idUnitDelete}")->fetch();

            if($unitMaterialwork) {
                $json["message"] = messageHelpers()->warning("Essa unidade está associada a um material!")->render();
                echo json_encode($json);
                return;
            }

            $unit = (new Unit())->findById($idUnitDelete);
            $unit->destroy();

            $json["updateHtml"] = "updateListModal";
            $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->render();


            $html = $this->view->render("/updateAjax/listUnit", [
            "units" => (new Unit())
                ->find()
                ->order("unit")
                ->limit(10)
                ->fetch(true)
            ]);

            $json["html"] = $html;
            echo json_encode($json);
        }    
    }

    public function user(?array $data) : void
    {
        $user = (new User())->find();
        $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
        $pager = new Pager(url("/user/p/"));
        $pager->pager($user->count(), 10, $page);


        echo $this->view->render("setingUser", [
            "title" => "OrçaFácil Usuários",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "usuarios" => $user
                    ->limit($pager->limit())
                    ->offset($pager->offset())
                    ->order("nome")
                    ->fetch(true),
            "paginator" => $pager->render()
        ]);
    }

    public function filterUser(array $data) : void
    {
        
        if(isset($data["page"]) && !empty($data["page"])){

            $user = (new User())->find();
            $page = (!empty($data['page']) && filter_var($data['page'], FILTER_VALIDATE_INT) >= 1 ? $data['page'] : 1);
            $pager = new Pager(url("/user/p/"));
            $pager->pager($user->count(), 10, $page);

            $html = $this->view->render("/updateAjax/listSetingUser", [
                "usuarios" => $user
                        ->limit($pager->limit())
                        ->offset($pager->offset())
                        ->order("nome")
                        ->fetch(true),
                "paginator" => $pager->render()
            ]);

            $json["html"] = $html;
            echo json_encode($json);
            return;
        }

        $nameSearch = ($data["search"] === "*" ? null : filter_var($data["search"], FILTER_SANITIZE_SPECIAL_CHARS));
        $status = filter_var($data["status"], FILTER_SANITIZE_SPECIAL_CHARS) === "2" ? null : filter_var($data['status'], FILTER_SANITIZE_SPECIAL_CHARS);   


        $conditions = [];
        $params = [];

        if (!empty($nameSearch)) {
            $conditions[] = "nome LIKE :n";
            $params['n'] = "%{$nameSearch}%";
        }

        if (!is_null($status)) {
            $conditions[] = "ativo = :a";
            $params['a'] = $status;
        }

        $where = implode(" AND ", $conditions);

        $user = (new User())->find($where, http_build_query($params));
        $pager = new Pager(url("/user/p/"));
        $pager->pager($user->count(), 10, 1);

        $html = $this->view->render("/updateAjax/listSetingUser", [
        "usuarios" => $user
            ->limit($pager->limit())
            ->offset($pager->offset())
            ->order("nome")
            ->fetch(true),
        "paginator" =>  $pager->render()
        ]);

        $json["html"] = $html;            
        echo json_encode($json);
        return;
    }

    public function newUser(?array $data) : void
    {
        
        if(isset($data['idUser'])) {
            $id = filter_var($data['idUser'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $userId = (new User())->findById($id);
        }

        if (!empty($data['csrf'])){           

            if(!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enivar, use o formulário!", "Erro de Envio")->render();
                $json["status"] = false;
                echo json_encode($json);
                return;
            }

            $resultado = cleanInputData($data);

            if(!$resultado['valid']) {
               $json['message'] = (new Message())->error("Preencha todos os campos!")->render();
               $json["status"] = false;
               echo json_encode($json);
               return;
            }
            
            $dataClear = $resultado['data'];
           
            $user = new User();
            $user->bootstrap(
                $dataClear['idEntidade'],
                $dataClear['nome'],
                $dataClear['telefone'],
                $dataClear['usuario'],
                $dataClear['email'],
                $dataClear['senha'],
                $dataClear['typeAccess'],
                $dataClear['status']
            );

            if(isset($userId)) {
                $user->id_usuarios = $userId->id_usuarios;
            }

            if($user->save()) {
                
                $json["resetForm"] = true;

                if(isset($userId)) {
                    $json["resetForm"] = false;
                }
                $json["message"] = $user->message()->render();

                $user = (new User())->find();
                $pager = new Pager(url("/user/p/1"));
                $pager->pager($user->count(), 10, 1);

                $html = $this->view->render("updateAjax/listSetingUser", [
                "usuarios" => $user
                        ->limit($pager->limit())
                        ->offset($pager->offset())
                        ->order("nome")
                        ->fetch(true),
                "paginator" => $pager->render()
                ]);
            
                $json["html"] = $html;
                $json["status"] = true;
                echo json_encode($json);
                return;
            };
        }

        echo $this->view->render("modal/modalNewUser", [
            "user" => $userId ?? null
        ]);    
    }

    public function report(?array $data) : void
    {
        echo $this->view->render("reports", [
           "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "recipients" => (new RecipientWork())->find("id_user = :u", "u={$this->user->id_usuarios}")->fetch(true)
        ]);
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
