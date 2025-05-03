<?php

namespace Source\App;

use Source\Core\Controller;

class App extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/". CONF_VIEW_APP ."/");
    }

    public function start(): void
    {
        var_dump("App");
    
        // echo $this->view->render("", [

        // ]);
    }

}
