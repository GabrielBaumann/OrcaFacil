<?php

namespace Source\App;

use Source\Core\Controller;
use Source\Models\Auth;

class AppSething extends Controller
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
    
    public function pageSething() : void
    {
        echo $this->view->render("/sethings/sething", [
            "title" => "OrçaFácil - Clientes",
            "usuario" => Auth::user()->nome ?? null,
            "typeAccess" => Auth::user()->type_access ?? null
        ]);
    }
}