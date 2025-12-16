<?php

namespace Source\App;

use Source\Models\Report\Access;
use Source\Core\Controller;
use Source\Models\Auth;
use Source\Models\RecipientWork;
use Source\Models\Report\Online;
use Source\Models\Views\VwExpensesStepsPrice;
use Source\Models\Views\VwGeneralExpensesPriceTotal;
use Source\Models\Views\VwPainelWork;
use Source\Models\Views\VwStatusWork;
use Source\Models\Work;

class AppStart extends Controller
{
    private $user;

    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");

        if (!$this->user = Auth::user()) {
            $this->message->warning("Efetue login para acessar o sistema.")->flash();
            redirect("/sessaoencerrada");
        }

        (new Access())->report();
        (new Online()->report());
    }
    
    public function pageStart() : void
    {

        // Gráfico de obras por status
        $workstoStatus = new VwStatusWork()->find()->fetch(true);

            $label = [];
            $value = [];

            if($workstoStatus) {
                foreach($workstoStatus as $item) {
                    $label[] = $item->status;
                    $value[] = $item->total_work;
                }
            }

        // Gráfico de gastos por categoria de material
        $materialtoSpent = new VwExpensesStepsPrice()->find()->fetch(true);

            $category = [];
            $totalSpent = [];

            if($materialtoSpent) {
                foreach ($materialtoSpent as $item) {
                    $category[] = $item->steps_work;
                    $totalSpent[] = $item->total_expenses;
                }
            }

            $totalMoney = new VwGeneralExpensesPriceTotal()
                ->find("budget = :bu","bu=execução","(SELECT SUM(expenses_work_total)) AS totalMoney")
                ->fetch();

            $totalWork = new Work()->find()->count();

            $averageMoneyWork = 0;

            if($totalWork > 0) {
                $averageMoneyWork = $totalMoney->totalMoney / $totalWork;
            }
        
            echo $this->view->render("/start/start", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "labelChart" => $label,
            "valueChart" => $value,
            "category" => $category,
            "totalSpent" => $totalSpent,
            "totalWorkFinished" => new Work()
                ->find("status = 'FINALIZADA'")
                ->count(),
            "totalWork" => $totalWork,
            "totalMoney" => $totalMoney,
            "recipients" => (new RecipientWork())
                ->find("id_user = :u", "u={$this->user->id_usuarios}")
                ->fetch(true),
            "averageMoneyWork" => $averageMoneyWork,
            "recentWorks" => (new RecipientWork())->find("id_user = :id", "id={$this->user->id_usuarios}")->limit(5)->fetch(true),
            "painellastWork" => new VwPainelWork()->find()->limit(5)->fetch(true) ?? null
        ]); 
    }

    public function sessionFinalized() : void
    {   
        echo $this->view->render("/session/sessionFinalized", [
            "title" => "Sessão Finalizada"
        ]);
    }

}
