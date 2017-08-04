<?php

$app->router->add("", function () use ($app) {
    $app->view->add("header", ["title" => "Home"]);
    $app->view->add("navbar/navbar");
    $app->view->add("home");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("about", function () use ($app) {
    $app->view->add("header", ["title" => "About"]);
    $app->view->add("navbar/navbar");
    $app->view->add("about");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("report", function () use ($app) {
    $app->view->add("header", ["title" => "Report"]);
    $app->view->add("navbar/navbar");
    $app->view->add("report");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("session", function () use ($app) {
    $app->view->add("header", ["title" => "Session"]);
    $app->view->add("navbar/navbar");
    $app->view->add("session");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("dice", function () use ($app) {
    $app->view->add("header", ["title" => "Dice"]);
    $app->view->add("navbar/navbar");
    $app->view->add("dice");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("login", function () use ($app) {
    $app->view->add("header", ["title" => "Login"]);
    $app->view->add("navbar/navbar");
    $app->view->add("login");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("status", function () use ($app) {
    $data = [
        "Server" => php_uname(),
        "PHP version" => phpversion(),
        "Included files" => count(get_included_files()),
        "Memory used" => memory_get_peak_usage(true),
        "Execution time" => microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'],
    ];

    $app->response->sendJson($data);
});

$app->router->add("sessionStatus", function () use ($app) {
    $data = [
        "Session start" => session_start(),
        "Session unset" => session_unset(),
        "Session destroy" => session_destroy(),
    ];

    $app->response->sendJson($data);
});
