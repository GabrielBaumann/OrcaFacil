<?php

namespace Source\App;

use Source\Core\Connect;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;
use Source\Models\Report\Access;
use Source\Models\Report\Online;
use Source\Models\User;

class Web extends Controller
{
    public function __construct()
    {
        parent::__construct(__DIR__ . "/../../themes/" . CONF_VIEW_THEME . "/");
        (new Access())->report();
        (new Online()->report());

    }

    public function home() : void 
    {
        echo $this->view->render("home", [
            "title" => "Home"
        ]);    
    }

    public function register(?array $data) : void
    {       
        if(isset($data["csrf"])) {
            $auth = new Auth();
            $user = new User();
            $user->name = $data["name"];
            $user->email = $data["mail"];
            $user->password = $data["password"];
            $user->save();

            if ($auth->register($user)) {
                $json["redirected"] = url("/confirmar");
            } else {
                $json["message"] = $auth->message()->render();
            } 

            echo json_encode($json);
            return;
        }

        echo $this->view->render("register", [
            "title" => "Cadastrar-se"
        ]);    
    }

    public function registerConfirmed() : void
    {
        echo $this->view->render("registerconfirmed", [
            "title" => "Falta pouco"
        ]);    
    }

    public function confirmed() : void
    {
        echo $this->view->render("confirmed", [
            "title" => "Ative sua conta"
        ]);
    }

    public function login(?array $data) : void
    {

        if (!empty($data['csrf'])) {

            if(!csrf_verify($data)) {
                $json['message'] = $this->message->error("Erro ao enivar, use o formulário!", "Erro de Envio")->render();
                echo json_encode($json);
                return;
            }

            if(empty($data['user']) || empty($data['password'])) {
                $json['message'] = $this->message->warning("Informe seu usuário e senha para entrar!")->render();
                echo json_encode($json);
                return;
            }

            $auth = (new Auth());

            if (!$auth->login($data['user'], $data['password'])) {
                $json['message'] = $auth->message()->render();
                echo json_encode($json);
                return;
            }

            $json['redirected'] = url("/inicio");
            echo json_encode($json);
            return;
        }

        echo $this->view->render("login", [
            "title" => "Login - OrçaFácil"
        ]);
    }

    public function error() : void
    {
        echo "<h1>404</h1>";    
    }

}