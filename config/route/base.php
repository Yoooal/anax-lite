<?php

$app->router->add("", function () use ($app) {
  $app->renderPage("home", "Home");
});

$app->router->add("about", function () use ($app) {
  $app->renderPage("about", "About");
});

$app->router->add("products", function () use ($app) {
  $app->renderPage("products", "Products");
});

$app->router->add("blog", function () use ($app) {
  $app->renderPage("blog", "Blog");
});

$app->router->add("cart", function () use ($app) {
  $app->renderPage("cart", "Cart");
});

$app->router->add("profile", function () use ($app) {
  $app->renderPage("login/profile", "Profile");
});

$app->router->add("webshop", function () use ($app) {
  $app->renderPage("admin/webshop", "Webshop");
});

$app->router->add("user", function () use ($app) {
  $app->renderPage("admin/user", "Users");
});

$app->router->add("content", function () use ($app) {
  $app->renderPage("admin/content", "Content");
});
