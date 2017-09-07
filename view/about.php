<?php
$db = $app->db;
$db->connect();
$textfilter = $app->textfilter;

$sql = $app->sqlCode->getSqlCode("page");
$content = $db->executeFetch($sql, ["about", "page"]);
$text = $textfilter->doFilter($content->data, $content->filter);
?>

<div class="container" role="main">
  <div class="page-header">
      <h1><?= esc($content->title) ?></h1>
  </div>
  <div class="page-content">
    <div class="col-md-3">
      <img src="img/sneaker.png" class="img-responsive" alt="Responsive image">
    </div>
    <div class="col-md-9">
      <?= $text ?>
    </div>
  </div>
</div>
