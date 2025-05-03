<?php

namespace Source\Models;

use Source\Core\Model;

class Auth extends Model
{
    public function __construct()
    {
        parent::__construct("usuarios",["id_usuarios", "id_entidade"],["nome", "email", "senha"]);
    }

    public function login(string $user, string $senha) : bool
    {
            
    }

}