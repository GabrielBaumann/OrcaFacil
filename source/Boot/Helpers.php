<?php

/**
 * URL
 */

 function url(?string $path = null) : string
 {
    if (strpos($_SERVER['HTTP_HOST'], "localhost") !== false) {
        if($path) {
            return CONF_URL_TEST . "/" . ($path[0] == "/" ? mb_substr($path, 1): $path);
        }
        return CONF_URL_TEST;
    }
    
    if ($path) {
        return CONF_URL_BASE . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE;
 }

function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

 /**
  * ASSETS
  */
function user() : ?\Source\Models\User
{
    return \Source\Models\Auth::user();    
}

function session(): \Source\Core\Session
{
    return new \Source\Core\Session();
}

function theme(?string $path = null, $theme = CONF_VIEW_THEME) : string
{
    if (strpos($_SERVER['HTTP_HOST'], "localhost") !== false) {
        if($path) {
            return CONF_URL_TEST . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1): $path);
        }
        return CONF_URL_TEST . "/themes/{$theme}";
    }
    
    if ($path) {
        return CONF_URL_BASE . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }
    return CONF_URL_BASE . "/themes/{$theme}";   
}

/**
 * REQUEST
 */
function csrf_input(): string
{
    $session = new \Source\Core\Session();
    $session->csrf();
    return "<input type='hidden' name='csrf' value='" . ($session->csrf_token ?? "") . "'/>";
}

function csrf_verify($request) : bool
{
    $session = new \Source\Core\Session();
    if (empty($session->csrf_token) || empty($request['csrf']) || $request['csrf'] != $session->csrf_token) {
        return false;
    }
    return true;
}

function flash() : ?string
{
    $session = new \Source\Core\Session();
    if ($flash = $session->flash()) {
        echo $flash;
    }
    return null;
}
 
/**
 * ####################
 * ###   PASSWORD   ###
 * ####################
 */

/**
 * @param string $password
 * @return string
 */
function passwd(string $password): string
{
    if (!empty(password_get_info($password)['algo'])) {
        return $password;
    }

    return password_hash($password, PASSWORD_DEFAULT, ["cost" => 10]);
}

/**
 * @param string $password
 * @param string $hash
 * @return bool
 */
function passwd_verify(string $password, string $hash): bool
{
    return password_verify($password, $hash);
}

/**
 * Funções de sanitização
 */

 function cleanInputData(array $data, array $requiredFields): array
 {
    $sanitezed = [];
    $errors = [];

    foreach ($requiredFields as $field) {
        if (!isset($data[$field])) {
            $errors[$field] = "Campo '$field' está vazio.";
            continue;
        }

        // Remove espaços em branco
        $value = trim($data[$field]);

        // Se estiver vazio após o trim, é inválido
        if ($value === "") {
            $errors[$field] = "Campo '$field' está vazio.";
            continue;
        }

        // Sanitize contra scripts e HTML

        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        $sanitezed[$field] = $value;
    }

    return [
        "valid" => empty($errors),
        "data" => $sanitezed,
        "errors" => $errors
    ];
}