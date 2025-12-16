<?php

ob_start();

require __DIR__ . "/vendor/autoload.php";

// BOOTSTRAP

use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

// WEB ROUTES

$route->namespace("Source\App");
$route->get("/", "Web:home");
$route->get("/login", "Web:login");
$route->post("/login", "Web:login");
$route->get("/criarconta", "Web:register");
$route->post("/criarconta", "Web:register");
$route->get("/confirmar", "Web:registerConfirmed");
$route->get("/obrigado/{email}", "Web:confirmed");

/**
 * APP ROUTES
 */

// Start
$route->get("/inicio", "AppStart:pageStart");
$route->get("/sessaoencerrada", "AppStart:sessionFinalized");

// Client
$route->get("/clientes", "AppClient:pageClient");
$route->get("/cadastrarcliente", "AppClient:addClient");
$route->post("/cadastrarcliente", "AppClient:addClient");
$route->get("/editarcliente/{idclient}", "AppClient:addClient");
$route->post("/cadastrarcliente/{idclient}", "AppClient:addClient");

$route->post("/excluircliente/{idclient}", "AppClient:deleteConfirmClient");

// Works
$route->get("/obras", "AppWork:pageWork");
$route->get("/cadastrarobra", "AppWork:addWork");
$route->post("/cadastrarobra", "AppWork:addWork");
$route->post("/cadastrarobra/{idwork}", "AppWork:addWork");
$route->get("/editarobra/{idwork}", "AppWork:addWork");

$route->get("/excluirobra/{idwork}", "AppWork:deleteWork");
$route->post("/confirmarexcluirobra/{idworkdelete}", "AppWork:deleteWork");

$route->get("/cadastrarobraclient/{idClient}", "AppWork:addWork");
$route->post("/editarcadastrarobra/{idObra}", "AppWork:addWork");

$route->get("/opcaoobra", "AppWork:addQuestion");
$route->get("/clienteobra/{idWork}/{budget}", "AppWork:workClient");

$route->get("/selecionaretapa/{idWork}/{expensesWork}/{budget}", "AppWork:checkStep");

$route->get("/gastomaterial/{idWork}/{idSteps}/{budget}", "AppWork:expensesMaterial");
$route->post("/gastomaterial", "AppWork:expensesMaterial");
$route->post("/gastomaterial/{idexpense}", "AppWork:expensesMaterial");


$route->get("/gastomaodeobra/{idWork}/{idSteps}/{budget}", "AppWork:expensesLabor");
$route->post("/gastomaodeobra", "AppWork:expensesLabor");
$route->post("/gastomaodeobra/{idexpense}", "AppWork:expensesLabor");

$route->get("/gastoaluguelequipamento/{idWork}/{idSteps}/{budget}", "AppWork:expensesRentalEquipment");
$route->post("/gastoaluguelequipamento", "AppWork:expensesRentalEquipment");
$route->post("/gastoaluguelequipamento/{idexpense}", "AppWork:expensesRentalEquipment");

$route->get("/gastoferramenta/{idWork}/{idSteps}/{budget}", "AppWork:expensesTool");
$route->post("/gastoferramenta", "AppWork:expensesTool");
$route->post("/gastoferramenta/{idexpense}", "AppWork:expensesTool");

$route->get("/gastocustoadministrativo/{idWork}/{idSteps}/{budget}", "AppWork:expensesAdministrative");
$route->post("/gastocustoadministrativo", "AppWork:expensesAdministrative");
$route->post("/gastocustoadministrativo/{idexpense}", "AppWork:expensesAdministrative");

$route->get("/editarcusto/{category}/{idexpense}/{idWork}/{idSteps}/{budget}", "AppWork:editExpenses");

$route->post("/confirmardeletargastos/{category}/{idexpense}/{budget}/{idwork}", "AppWork:deleteConfirmExpenses");
$route->post("/deletargastos", "AppWork:deleteExpenses");


// Reports
$route->get("/relatorios", "AppReport:pageReport");


// Settings

// beneficiary works
$route->get("/configuracao", "AppSething:pageSething");
$route->post("/recipient", "App:recipientWork");
$route->get("/recipient/p/{page}", "App:recipientWork");
$route->get("/see/{idWork}", "App:seeDetails");
$route->post("/seefilter", "App:filterSee");
$route->get("/addrecipient", "App:addRecipient");
$route->post("/addrecipient", "App:addRecipient");
$route->post("/validatecpf", "App:validateCpf");
$route->get("/registerMaterial/{idWork}", "App:registerMaterial");
$route->post("/registerMaterial", "App:registerMaterial");



// unit
$route->get("/unit", "App:unit");
$route->get("/cadUnit", "App:cadUnit");
$route->get("/cadUnit/{idUnit}", "App:cadUnit");
$route->post("/cadUnit/{idUnit}", "App:cadUnit");
$route->post("/deleteUnit/{idUnitDelete}", "App:deleteUnit");
$route->post("/cadUnit", "App:cadUnit");
$route->post("/filterUnit", "App:filterUnit");

// User
$route->get("/user", "App:user");
$route->get("/user/p/{page}", "App:filterUser");
$route->post("/filter", "App:filterUser");
$route->get("/newuser", "App:newUser");
$route->post("/newuser", "App:newUser");
$route->get("/newuser/{idUser}", "App:newUser");
$route->post("/newuser/{idUser}", "App:newUser");

// Reports
$route->get("/report", "App:report");




// Exit App

$route->get("/exit", "App:logout");

// ERROR ROUTES

$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

// ROUTE

$route->dispatch();

// ERROR REDIRECT

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}

ob_end_flush();