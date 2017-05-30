<?php

$navbar = [
    "items" => [
        "hem" => [
            "text" => "Home",
            "route" => "",
        ],
        "about" => [
            "text" => "About",
            "route" => "about",
        ],
        "report" => [
            "text" => "Report",
            "route" => "report",
        ],
        "session" => [
            "text" => "Session",
            "route" => "session",
        ],
    ]
];

foreach ($navbar["items"] as $key => $value) {
  foreach ($value as $key => $value) {
    if ($key == "text") {
      $text = $value;
    }
    elseif ($key == "route") {
      $route = $app->url->create($value);
    }
  }
  $html .= "<li><a href=$route>$text</a></li>";
}

?>

<body role="document">
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href=" ">OOPHP</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <?php echo $html; ?>
        </ul>
      </div>
    </div>
  </nav>
