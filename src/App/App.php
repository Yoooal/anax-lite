<?php

namespace joel\App;

/**
 * An App class to wrap the resources of the framework.
 */
class App
{

  public function renderPage($page, $title) {
    $this->view->add("header", ["title" => "$title"]);
    $this->view->add("navbar/navbar");
    $this->view->add("$page");
    $this->view->add("footer");

    $this->response->setBody([$this->view, "render"])
                  ->send();
  }

}
