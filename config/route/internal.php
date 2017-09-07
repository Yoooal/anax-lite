<?php

$app->router->add('blog/{slug}', function ($slug) use ($app) {
  $app->renderPage("blogpost", "$slug");
});

$app->router->add('pages/{page}', function ($page) use ($app) {
  $app->renderPage("page", "$page");
});

$app->router->add("delete", function () use ($app) {
  $app->renderPage("admin/delete", "Delete");
});

$app->router->add("edit", function () use ($app) {
  $app->renderPage("admin/edit", "Edit");
});

$app->router->add("editWebshop", function () use ($app) {
  $app->renderPage("admin/editWebshop", "Edit");
});

$app->router->add("logout", function () use ($app) {
  $app->renderPage("login/logout", "Logout");
});

$app->router->add("handle_new_user", function () use ($app) {
  $app->renderPage("login/handle_new_user", "New User");
});

$app->router->add("validate", function () use ($app) {
  $app->renderPage("login/validate", "Validate");
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

$app->router->addInternal("404", function () use ($app) {
    $currentRoute = $app->request->getRoute();
    $routes = "<ul>";
    foreach ($app->router->getAll() as $route) {
        $routes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $routes .= "</ul>";

    $intRoutes = "<ul>";
    foreach ($app->router->getInternal() as $route) {
        $intRoutes .= "<li>'" . $route->getRule() . "'</li>";
    }
    $intRoutes .= "</ul>";

    $body = <<<EOD
<!doctype html>
<meta charset="utf-8">
<title>404</title>
<h1>404 Not Found</h1>
<p>The route '$currentRoute' could not be found!</p>
<h2>Routes loaded</h2>
<p>The following routes are loaded:</p>
$routes
<p>The following internal routes are loaded:</p>
$intRoutes
EOD;

    $app->response->setBody($body)
              ->send();
});
