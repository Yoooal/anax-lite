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

$app->router->add("welcome", function () use ($app) {
    $app->view->add("header", ["title" => "Profile"]);
    $app->view->add("navbar/navbar");
    $app->view->add("login/welcome");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});

$app->router->add("admin", function () use ($app) {
    $app->view->add("header", ["title" => "Admin"]);
    $app->view->add("navbar/navbar");
    $app->view->add("login/admin");
    $app->view->add("footer");

    $app->response->setBody([$app->view, "render"])
                  ->send();
});
