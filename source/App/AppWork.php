<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\Client;
use Source\Models\Costs\CostsAdministrative;
use Source\Models\Costs\CostsLabor;
use Source\Models\Costs\CostsMaterial;
use Source\Models\Costs\CostsRetalEquipment;
use Source\Models\Costs\CostsTool;
use Source\Models\Expenses\ExpensesAdministrative;
use Source\Models\Expenses\ExpensesLabor;
use Source\Models\Expenses\ExpensesMaterial;
use Source\Models\Expenses\ExpensesRentalEquipment;
use Source\Models\Expenses\ExpensesTool;
use Source\Models\Location;
use Source\Models\MaterialWork;
use Source\Models\StepsWork;
use Source\Models\Unit;
use Source\Models\Views\VwGeneralExpenses;
use Source\Models\Views\VwGeneralExpensesPriceTotal;
use Source\Models\Views\VwWorkClient;
use Source\Models\Work;

class AppWork extends Controller
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
    
    public function pageWork() : void
    {
        echo $this->view->render("works", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome ?? null,
            "typeAccess" => Auth::user()->type_access ?? null,
            "recipients" => new VwWorkClient()->find()->fetch(true)
        ]);   
    }

    // Cadastrar obra
    public function addWork(?array $data) : void
    {

        if(!empty($data['csrf'])) {
            $addWork = new Work();
            $verifyData = cleanInputData($data, ["detail-work"]);

            if(!$verifyData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $verifyData["data"];

            $addWork->bootstrap(
                1,
                $dataClean["client"],
                $dataClean["name-work"],
                $dataClean["address"],
                $dataClean["type-work"],
                $dataClean["location-work"],
                $dataClean["date-start-work"],
                $dataClean["date-end-work"],
                $dataClean["detail-work"],
                "CADASTRADA"
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($data["idwork"]) && !empty($data["idwork"])) {
                $addWork->id_work = $data["idwork"];
                $addWork->id_user_system_update = 1;
            }
            
            $addWork->save();

            if(isset($data["idwork"]) && !empty($data["idwork"])) {
                $json["message"] = $addWork->message()->render();
                echo json_encode($json);
                return;
            }

            $idWork = $addWork->id_work;

            $html = $this->view->render("/modal/modalYesNo", [
                "idwork" => $idWork
            ]);

            $json["html"] = $html;
            $json["message"] = $addWork->message()->render();
            echo json_encode($json);
            return;
        }

        $client = (new Client())->find()->fetch(true);

        if(isset($data["idClient"]) && !empty($data["idClient"])) {
            $client = new Client();
            $idClient = $client->findById(filter_var($data["idClient"], FILTER_VALIDATE_INT));
        }

        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Obras",
            "url" => url("/obras"),
            "titleForms" => "Nova Obra",
            "textForms" => "Preencha os dados abaixo para cadastrar uma nova obra",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formWork", [
            "default" => $defaultFormsObj,
            "location" => new Location()->find()->fetch(true),
            "idClient" => $idClient ?? null,
            "client" => $client ?? null,
            "editWorkClient" => new Work()->findById($data["idwork"] ?? 0)
        ]);
    }


    public function addQuestion() : void
    {
        echo $this->view->render("/modal/modalYesNo", [
        ]);
    }

    // Página de custo da obra do cliente
    public function workClient(array $data) : void
    {   
        $idWork = filter_var($data["idWork"], FILTER_VALIDATE_INT);
        $clientWork = (new VwWorkClient())->findById($idWork);

        $budget = (int)$data["budget"] === 1 ? "orçamento" : "execução";
        
        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Obras",
            "url" => url("/obras"),
            "titleForms" => "Nova Obra",
            "textForms" => "Preencha os dados abaixo para cadastrar uma nova obra",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/worksClient", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome ?? null,
            "typeAccess" => Auth::user()->type_access ?? null,
            "default" => $defaultFormsObj,
            "recipients" => new VwGeneralExpenses()->find("id_work = :id AND budget LIKE :bu","id={$idWork}&bu={$budget}")->fetch(true) ?? null,
            "clientWork" => $clientWork,
            "expensesWorkTotal" => new VwGeneralExpensesPriceTotal()->find("id_work = :id AND budget LIKE :bu","id={$idWork}&bu=execução")->fetch(),
            "budgetTotal" => new VwGeneralExpensesPriceTotal()->find("id_work = :id AND budget LIKE :bu","id={$idWork}&bu=orçamento")->fetch(),
            "budget" => $data["budget"]
        ]);
    }

    // Selecionar a etapa de construção onde o custo será alocado - Modal
    public function checkStep(array $data) : void
    {
        $idWork = filter_var($data["idWork"], FILTER_VALIDATE_INT);
        $expensesWork = filter_var($data["expensesWork"], FILTER_VALIDATE_INT);
        $budget = filter_var($data["budget"], FILTER_VALIDATE_INT);

        $expenses = "";

        switch ( $expensesWork) {
            case 1:
                $expenses = "Materiais";
                $urlAddExpenses = url("/gastomaterial") ;
                break;
            case 2:
                $expenses = "Mão de Obra";
                $urlAddExpenses = url("/gastomaodeobra") ;
                break;
            case 3:
                $expenses = "Aluguel de Equipamento";
                $urlAddExpenses = url("/gastoaluguelequipamento") ;
                break;
            case 4:
                $expenses = "Ferramentas";
                $urlAddExpenses = url("/gastoferramenta") ;
                break;
            case 5:
                $expenses = "Custos Administrativos";
                $urlAddExpenses = url("/gastocustoadministrativo") ;
                break;
            default:
                $expenses = "Erro";
        }

        $stepsWork = (new StepsWork())->find()->order("id_steps_work")->fetch(true);

        $html = $this->view->render("/works/modalCheckStep", [
            "idWork" => $idWork,
            "textExpenses" => $expenses,
            "urlExpenses" => $urlAddExpenses,
            "stepsWork" => $stepsWork,
            "budget" => $budget
        ]);

        $json["html"] = $html;
        echo json_encode($json);        
    }

    // Cadastrar custo com materiais
    public function expensesMaterial(?array $data) : void
    {   
        if(isset($data["budget"]) && !empty($data["budget"])) {
            $budget = (int)$data["budget"] === 1 ? "Orçamento" : "Execução";
        }
            
        if(!empty($data["csrf"])) {

            $expensesMaterial = (new ExpensesMaterial());
            $dataSanitize = cleanInputData($data, ["detail"]);

            if(!$dataSanitize["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha todos os campos obrigatórios!")->render();
                echo json_encode($json);
                return;
            }

            $dataClean = $dataSanitize["data"];
            $budget = (int)$dataClean["id-budget"] === 1 ? "orçamento" : "execução";
            $expensesMaterial->bootstrap(
                1,
                $dataClean["id-work"],
                $dataClean["id-step-work"],
                $dataClean["material"],
                $dataClean["unit"],
                floatval($dataClean["amount-work"]),
                clearCurrency($dataClean["price-unit"]),
                $dataClean["detail"],
                $budget
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($data["idexpense"]) && !empty($data["idexpense"])) {
                $expensesMaterial-> id_expenses_material = $data["idexpense"];
                $expensesMaterial->id_user_system_update = 1;
            }

            $expensesMaterial->save();

            // Mudar status da obra
            if($budget === "execução") {
                $statusWork = new Work;
                $statusWork->fncStatusWorks(1,$dataClean["id-work"]); 
            }

            $json["message"] = $expensesMaterial->message()->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Custo",
            "url" => url("/clienteobra/{$data["idWork"]}/{$data["budget"]}"),
            "titleForms" => "Novo custo com material ({$budget})",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo custo com material",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formExpensesMaterial", [
            "default" => $defaultFormsObj ?? null,
            "stepWork" => (new StepsWork())->findById($data["idSteps"]) ?? null,
            "idStepWorker" => $data["idSteps"] ?? null ,
            "idWork" => $data["idWork"] ?? null,
            "material" => (new CostsMaterial())->find()->order("name_material")->fetch(true),
            "unit" =>(new Unit()->find()->fetch(true)),
            "editMaterial" => (new ExpensesMaterial())->findById($data["idexpense"] ?? 0 ),
            "category" => $data["category"] ?? 0,
            "budget" => $data["budget"] ?? 0
        ]);
    }

    // Cadastrar custo com mão de obras
    public function expensesLabor(?array $data) : void
    {
        if(isset($data["budget"]) && !empty($data["budget"])) {
            $budget = (int)$data["budget"] === 1 ? "Orçamento" : "Execução";
        }

        if(!empty($data["csrf"])) {

            $dataClen = cleanInputData($data, ["amount-work", "price-daily", "price-contract", "detail", "name-labor"]);
            if(!$dataClen["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatório (*).")->render();
                echo json_encode($json);
                return;
            }

            $formatLabor = $dataClen["data"];

            if($formatLabor["format-labor"] === "DIARIA") {
                $dataSanitize = cleanInputData($data, ["price-contract", "detail", "name-labor"]);
            }

            if($formatLabor["format-labor"] === "EMPREITA") {
                $dataSanitize = cleanInputData($data, ["amount-work", "price-daily", "detail", "name-labor"]);
            }

            if(!$dataSanitize["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatório (*).")->render();
                echo json_encode($json);
                return;
            }

            $dataCleanSanitize = $dataSanitize["data"];
            $budget = (int)$dataCleanSanitize["id-budget"] === 1 ? "orçamento" : "execução";
            $expensesLabor = (new ExpensesLabor());

            $expensesLabor->bootstrap(
                1,
                $dataCleanSanitize["id-work"],
                $dataCleanSanitize["id-step-work"],
                $dataCleanSanitize["labor"],
                $dataCleanSanitize["name-labor"],
                $dataCleanSanitize["format-labor"],
                floatval($dataCleanSanitize["amount-work"]),
                clearCurrency($dataCleanSanitize["price-daily"]),
                clearCurrency($dataCleanSanitize["price-contract"]),
                $dataCleanSanitize["detail"],
                $budget
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($data["idexpense"]) && !empty($data["idexpense"])) {
                $expensesLabor->id_expenses_labor = $data["idexpense"];
                $expensesLabor->id_user_system_update = 1;
            }

            $expensesLabor->save();

            // Mudar status da obra
            if($budget === "execução") {
                $statusWork = new Work;
                $statusWork->fncStatusWorks(1,$dataCleanSanitize["id-work"]); 
            }

            $json["message"] = $expensesLabor->message()->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }


        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Custo",
            "url" => url("/clienteobra/{$data["idWork"]}/{$data["budget"]}"),
            "titleForms" => "Novo custo com mão de obra ({$budget})",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo custo com mão de obra",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formExpensesLabor", [
            "default" => $defaultFormsObj,
            "stepWork" => (new StepsWork())->findById($data["idSteps"]),
            "idStepWorker" => $data["idSteps"],
            "idWork" => $data["idWork"],
            "labor" => (new CostsLabor())->find()->order("name_labor")->fetch(true),
            "editLabor" => (new ExpensesLabor())->findById($data["idexpense"] ?? 0),
            "category" => $data["category"] ?? 0,
            "budget" => $data["budget"] ?? 0
        ]); 
    }

    // Cadastrar custos com aluguel de equipamento
    public function expensesRentalEquipment(?array $data): void
    {
        if(isset($data["budget"]) && !empty($data["budget"])) {
            $budget = (int)$data["budget"] === 1 ? "Orçamento" : "Execução";
        }

        if(!empty($data["csrf"])) {

            $sanitizeData = cleanInputData($data, ["detail-rental"]);

            if(!$sanitizeData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatório (*).")->render();
                echo json_encode($json);
                return;                
            }

            $dataClean = $sanitizeData["data"];
            $budget = (int)$dataClean["id-budget"] === 1 ? "orçamento" : "execução";

            $expensesRental = (new ExpensesRentalEquipment());
            $expensesRental->bootstrap(
                1,
                $dataClean["id-work"],
                $dataClean["id-step-work"],
                $dataClean["equipment-rental"],
                $dataClean["date-start-rental"],
                $dataClean["date-end-rental"],
                clearCurrency($dataClean["price-dail-rental"]),
                $dataClean["detail-rental"],
                $budget
            );

            $expensesRental->save();

            // Mudar status da obra
            if($budget === "execução") {
                $statusWork = new Work;
                $statusWork->fncStatusWorks(1,$dataClean["id-work"]); 
            }  

            $json["message"] = $expensesRental->message()->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Custo",
            "url" => url("/clienteobra/{$data["idWork"]}/{$data["budget"]}"),
            "titleForms" => "Novo custo com aluguel de equipamento ({$budget})",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo custo com aluguel de equipamento",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formExpensesRentalEquipment", [
            "default" => $defaultFormsObj,
            "stepWork" => (new StepsWork())->findById($data["idSteps"]),
            "idStepWorker" => $data["idSteps"],
            "idWork" => $data["idWork"],
            "retalEquipment" => (new CostsRetalEquipment())->find()->order("name_equipment")->fetch(true),
            "editRentalEquipment" => (new ExpensesRentalEquipment())->findById($data["idexpense"] ?? 0),
            "category" => $data["category"] ?? 0,
            "budget" => $data["budget"] ?? 0
        ]); 
    }

    // Cadastrar custos com ferramentas
    public function expensesTool(?array $data): void
    {
        if(isset($data["budget"]) && !empty($data["budget"])) {
            $budget = (int)$data["budget"] === 1 ? "Orçamento" : "Execução";
        }

        if(!empty($data["csrf"])) {

            $sanitizeData = cleanInputData($data, ["detail"]);

            if(!$sanitizeData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatório (*).")->render();
                echo json_encode($json);
                return;                
            }

            $dataClean = $sanitizeData["data"];
            $budget = (int)$dataClean["id-budget"] === 1 ? "orçamento" : "execução";
            $expensesTool = new ExpensesTool();

            $expensesTool->bootstrap(
                1,
                $dataClean["id-work"],
                $dataClean["id-step-work"],
                $dataClean["tool"],
                $dataClean["unit-tool"],
                floatval($dataClean["amount-tool"]),
                clearCurrency($dataClean["price-unit-tool"]),
                $dataClean["detail"],
                $budget
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($data["idexpense"]) && !empty($data["idexpense"])) {
                $expensesTool->id_expenses_tool = $data["idexpense"];
                $expensesTool->id_user_system_update = 1;
            }

            $expensesTool->save();

            // Mudar status da obra
            if($budget === "execução") {
                $statusWork = new Work;
                $statusWork->fncStatusWorks(1,$dataClean["id-work"]); 
            }            

            $json["message"] = $expensesTool->message()->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Custo",
            "url" => url("/clienteobra/{$data["idWork"]}/{$data["budget"]}"),
            "titleForms" => "Novo custo com ferramenta ({$budget})",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo custo com ferramenta",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formExpensesTool", [
            "default" => $defaultFormsObj,
            "stepWork" => (new StepsWork())->findById($data["idSteps"]),
            "idStepWorker" => $data["idSteps"],
            "idWork" => $data["idWork"],
            "unit" => (new Unit())->find()->order("abbreviation")->fetch(true),
            "tool" => (new CostsTool())->find()->order("name_tool")->fetch(true),
            "editTool" => (new ExpensesTool())->findById($data["idexpense"] ?? 0),
            "category" => $data["category"] ?? 0,
            "budget" => $data["budget"] ?? 0
        ]); 
    }

    // Cadastrar gastos administrativos
    public function expensesAdministrative(?array $data) : void
    {
        if(isset($data["budget"]) && !empty($data["budget"])) {
            $budget = (int)$data["budget"] === 1 ? "Orçamento" : "Execução";
        }

        if(!empty($data["csrf"])) {
            
            $sanitizeData = cleanInputData($data, ["detail"]);

            if(!$sanitizeData["valid"]) {
                $json["message"] = messageHelpers()->warning("Preencha os campos obrigatório (*).")->render();
                echo json_encode($json);
                return;                
            }
            
            $dataClean = $sanitizeData["data"];
            $budget = (int)$dataClean["id-budget"] === 1 ? "orçamento" : "execução";
            $expensesAdministrative = new ExpensesAdministrative();

            $expensesAdministrative->bootstrap(
                1,
                $dataClean["id-work"],
                $dataClean["id-step-work"],
                $dataClean["service-administrative"],
                clearCurrency($dataClean["price-service-administrative"]),
                $dataClean["detail"],
                $budget
            );

            // Caso já tenha um ID significa que é uma edição e atualiza o registro
            if(isset($data["idexpense"]) && !empty($data["idexpense"])) {
                $expensesAdministrative->id_expenses_administrative = $data["idexpense"];
                $expensesAdministrative->id_user_system_update = 1;
            }

            $expensesAdministrative->save();

            // Mudar status da obra
            if($budget === "execução") {
                $statusWork = new Work;
                $statusWork->fncStatusWorks(1,$dataClean["id-work"]); 
            }    

            $json["message"] = $expensesAdministrative->message()->render();
            $json["complete"] = true;
            echo json_encode($json);
            return;
        }

        $defaultForms = [
            "title" => "OrçaFácil - Cadastro de Custo",
            "url" => url("/clienteobra/{$data["idWork"]}/{$data["budget"]}"),
            "titleForms" => "Novo custo com despesas administrativas ({$budget})",
            "textForms" => "Preencha os dados abaixo para cadastrar um novo custo com despesas administrativas",
        ];
        $defaultFormsObj = (object) $defaultForms;

        echo $this->view->render("/works/formExpensesAdministrative", [
            "default" => $defaultFormsObj,
            "stepWork" => (new StepsWork())->findById($data["idSteps"]),
            "idStepWorker" => $data["idSteps"],
            "idWork" => $data["idWork"],
            "costsAdministrative" => (new CostsAdministrative())->find()->order("name_administrative")->fetch(true),
            "editAdministrative" => (new ExpensesAdministrative())->findById($data["idexpense"] ?? 0),
            "category" => $data["category"] ?? 0,
            "budget" => $data["budget"] ?? 0
        ]); 
    }

    // Editar gastos baseado nas categorias das despesas (expenses)
    public function editExpenses(?array $data) : void
    {
        
        if($data["category"] === "1") {
            $this->expensesMaterial($data);
        }

        if($data["category"] === "2") {
            $this->expensesLabor($data);
        }

        if($data["category"] === "3") {
            $this->expensesRentalEquipment($data);
        }

        if($data["category"] === "4") {
            $this->expensesTool($data);
        }    

        if($data["category"] === "5") {
            $this->expensesAdministrative($data);
        }   
    }

    // Modal para confirmar a exclusão de custos
    public function deleteConfirmExpenses(array $data) : void
    {

        $html = $this->view->render("/works/modalYesNoDelete", [
            "category" => $data["category"],
            "idexpenses" => $data["idexpense"],
            "budget" => $data["budget"],
            "idwork" => $data["idwork"]
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;
    }

    // Excluir gastos
    public function deleteExpenses(array $data) : void
    {      
        if($data["category"] === "1") {
            $expenseMaterial = new ExpensesMaterial();
            $expenseMaterial->delete("id_expenses_material = :id","id={$data["idexpense"]}");

            if($expenseMaterial) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/clienteobra/{$data["idwork"]}/{$data["budget"]}");
                echo json_encode($json);
            }
        }

        if($data["category"] === "2") {
            $expenseMaterial = new ExpensesLabor();
            $expenseMaterial->delete("id_expenses_labor = :id","id={$data["idexpense"]}");

            if($expenseMaterial) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/clienteobra/{$data["idwork"]}/{$data["budget"]}");
                echo json_encode($json);
            }
        }

        if($data["category"] === "3") {
            $expenseMaterial = new ExpensesRentalEquipment();
            $expenseMaterial->delete("id_expenses_rental_equipment = :id","id={$data["idexpense"]}");

            if($expenseMaterial) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/clienteobra/{$data["idwork"]}/{$data["budget"]}");
                echo json_encode($json);
            }
        }

        if($data["category"] === "4") {
            $expenseMaterial = new ExpensesTool();
            $expenseMaterial->delete("id_expenses_tool = :id","id={$data["idexpense"]}");

            if($expenseMaterial) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/clienteobra/{$data["idwork"]}/{$data["budget"]}");
                echo json_encode($json);
            }
        }

        if($data["category"] === "5") {
            $expenseMaterial = new ExpensesAdministrative();
            $expenseMaterial->delete("id_expenses_administrative = :id","id={$data["idexpense"]}");

            if($expenseMaterial) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/clienteobra/{$data["idwork"]}/{$data["budget"]}");
                echo json_encode($json);
            }
        }

    }

    // Excluir obra
    public function deleteWork(array $data) : void
    {
        if(isset($data["idworkdelete"])) {
            $work = (new Work())->delete("id_work = :id","id={$data["idworkdelete"]}");

            if($work) {
                $json["message"] = messageHelpers()->success("Registro excluído com sucesso!")->flash();
                $json["redirect"] = url("/obras");
                echo json_encode($json);
                return;   
            }

            $json["message"] = messageHelpers()->success("Erro ao tentar exluir esse registro, tente novamente!")->render();
            echo json_encode($json);
            return;
        }

        $html = $this->view->render("/works/modalWorkDelete", [
            "idWork" => $data["idwork"],
        ]);

        $json["html"] = $html;
        echo json_encode($json);
        return;  
    }
}