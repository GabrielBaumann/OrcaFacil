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


/**
 * APP
 */

 // Works
$route->get("/start", "App:start");
$route->get("/see", "App:seeDetails");
$route->get("/registerMaterial", "App:registerMaterial");

// User
$route->get("/user", "App:user");
$route->get("/newuser", "App:newUser");
$route->post("/newuser", "App:newUser");
$route->get("/newuser/{idUser}", "App:newUser");
$route->post("/newuser/{idUser}", "App:newUser");



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