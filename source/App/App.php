<?php

namespace Source\App;

use EmptyIterator;
use Source\Core\Controller;
use Source\Core\Session;
use Source\Models\Auth;
use Source\Models\User;
use Source\Support\Message;

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

    public function start(): void
    {
        $session = new Session();

        echo $this->view->render("works", [
            "title" => "OrçaFácil - Obras",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access
        ]);
    }

    public function seeDetails() : void
    {
        echo $this->view->render("modal/modalViewDetails", [
            
        ]);
    }

    public function registerMaterial() : void
    {
        echo $this->view->render("modal/modalRegistrationMaterial", [

        ]);    
    }

    public function user() : void
    {

        echo $this->view->render("setingUser", [
            "title" => "OrçaFácil Usuários",
            "usuario" => Auth::user()->nome,
            "typeAccess" => Auth::user()->type_access,
            "usuarios" => (new User())->find()->order("nome")->fetch(true)
        ]);
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
                echo json_encode($json);
                return;
            }

            $arrayKeys = array_keys($data);

            $resultado = cleanInputData($data, $arrayKeys);

            if(!$resultado['valid']) {
               $json['message'] = (new Message())->error("Preencha todos os campos!")->render();
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
                $json['message'] = (new Message)->success("Cadastro feito com sucesso")->render();
                $json['redirected'] = url("/user");
                echo json_encode($json);
                return;
            };

            $json['message'] = (new Message)->error("Erro vamos investigar", "Desculpe")->render();
            echo json_encode($json);
            return;
        }

        echo $this->view->render("modal/modalNewUser", [
            "user" => $userId ?? null
        ]);    
    }

    public function logout()
    {
        (new Message())->success("Você saiu com sucesso " . Auth::user()->nome . ". Volte logo :)")->flash();    
        
        Auth::logout();
        redirect("/");
    }

}
