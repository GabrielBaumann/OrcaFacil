<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;

class AppReport extends Controller
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
    
    public function pageReport() : void
    {
        var_dump("Relatório");
        // echo $this->view->render("client", [
        //     "title" => "OrçaFácil - Clientes",
        //     "usuario" => Auth::user()->nome ?? null,
        //     "typeAccess" => Auth::user()->type_access ?? null,
        //     "listClient" => new Client()->find()->fetch(true)
        // ]);
    }
}