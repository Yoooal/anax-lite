<?php

namespace joel\Navbar;

class Navbar implements \Anax\Common\AppInjectableInterface,
\Anax\Common\ConfigureInterface
{
    use \Anax\Common\AppInjectableTrait;
    use \Anax\Common\ConfigureTrait;

    public function getHTML() {
      $navbar = $this->config;
      $html = "";
      foreach ($navbar["items"] as $key => $value) {
        foreach ($value as $key => $value) {
          if ($key == "text") {
            $text = $value;
          }
          elseif ($key == "route") {
            $active = $this->app->request->getRoute() == $value ? "active" : "";
            $route = $this->app->url->create($value);
          }
        }
        $html .= "<li class='$active'><a href=$route>$text</a></li>";
      }
      return $html;
    }

    public function setCurrentRoute($route)
    {
        ;
    }

    public function setUrlCreator($urlCreate)
    {
        ;
    }
}
