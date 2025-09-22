<?php

namespace Source\Models;

use Source\Core\Email;
use Source\Core\Model;
use Source\Core\Session;
use Source\Core\View;

class Auth extends Model
{
    public function __construct()
    {
        parent::__construct("user_system",["id_user_system"],["name", "email", "password"], "id_user_system");
    }

    public static function user() : ?User
    {
        $session = new Session();
        
        if (!$session->has("authUser")){
            return null;
        }

        return (new User())->findById($session->authUser);    
    }

    public static function logout() : void
    {
        $session = new Session();
        $session->unset("authUser");
    }

    public function login(string $user, string $senha) : bool
    {
        $instanciaUser = (new User())->find("usuario = :u", "u={$user}");
        $user = $instanciaUser->fetch();

        if (!$user) {
            $this->message->error("O usuário informado não está cadastrado!");
            return false;
        }
        
        // Inserir a verificação de hash de senha
        if ($user->senha !== $senha) {
            $this->message->error("A senha informada não confere!");
            return false;
        }

        if ($user->ativo === 0) {
            $this->message->error("Usuário desativado do sistema!");
            return false;
        }

        // LOGIN

        (new Session())->set("authUser", $user->id_usuarios);
        $this->message->success("Login efetuado com sucesso")->flash();
        return true;
    }

    public function register(User $user) : bool
    {
        if (!$user->save()) {
            $this->message = $user->message;
            return false;
        }

        $view = new View(__DIR__ . "/../../themes/orcaemail");
        $message = $view->render("confirm", [
            "name" => $user->name,
            "email" => $user->email,
            "id" => $user->id_user_system,
            "confirm_link" => url("/brigado/" . base64_encode($user->email))
        ]);

        (new Email())->bootstrap(
            "Ative usa conta no Orça Fácil",
            $message,
            $user->email,
            "{$user->name}"
        )->send();

        return true;
    }

}