<?php

namespace Source\Models;

use Source\Core\Model;

class User extends Model
{
    public function __construct()
    {
        parent::__construct(
            "user_system", ["id_user_system"], ["name", "password"], "id_user_system"
        );
    }

    public function bootstrap(
        int $id_entidade,
        string $nome,
        string $telefone,
        string $usuario,
        string $email,
        string $senha,
        string $typeAccess,
        int $ativo
    ) : User {
        $this->id_entidade = $id_entidade;
        $this->nome = $nome;
        $this->telefone = $telefone;
        $this->usuario = $usuario;
        $this->email = $email;
        $this->senha = $senha;
        $this->type_access = $typeAccess;
        $this->ativo = $ativo;
        return $this;
    }
}