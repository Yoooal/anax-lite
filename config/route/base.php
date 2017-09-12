<?php

$app->router->add("", function () use ($app) {
  $app->renderPage("home", "Home");
});

$app->router->add("about", function () use ($app) {
  $app->renderPage("about", "About");
});

$app->router->add("report", function () use ($app) {
  $app->renderPage("report", "Report");
});

$app->router->add("session", function () use ($app) {
  $app->renderPage("session", "Session");
});

$app->router->add("dice", function () use ($app) {
  $app->renderPage("dice", "Dice");
});

$app->router->add("blog", function () use ($app) {
  $app->renderPage("blog", "Blog");
});

$app->router->add("pages", function () use ($app) {
  $app->renderPage("pages", "Pages");
});

$app->router->add("profile", function () use ($app) {
  $app->renderPage("login/profile", "Profile");
});

$app->router->add("webshop", function () use ($app) {
  $app->renderPage("webshop", "Webshop");
});

$app->router->add("user", function () use ($app) {
  $app->renderPage("user", "Users");
});

$app->router->add("content", function () use ($app) {
  $app->renderPage("content", "Content");
});
