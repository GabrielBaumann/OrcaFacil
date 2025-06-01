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
$route->get("/", "Web:login");
$route->post("/", "Web:login");
$route->post("/teste", "Web:login");


/**
 * APP ROUTES
 */

// beneficiary works
$route->get("/recipient", "App:recipientWork");
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