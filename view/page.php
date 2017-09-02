<?php
$db = $app->db;
$db->connect();
$textfilter = $app->textfilter;

$sql = $app->sqlCode->getSqlCode("page");
$route = $_SERVER["PATH_INFO"];
$page = substr($route, 7);
$content = $db->executeFetch($sql, [$page, "page"]);

$text = $textfilter->doFilter($content->data, $content->filter);

?>

<div class="container" role="main">
  <div class="page-header">
      <h1><?= esc($content->title) ?></h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12 bak">
        <article>
            <header>
                <p><i>Latest update: <time datetime="<?= esc($content->modified_iso8601) ?>" pubdate><?= esc($content->modified) ?></time></i></p>
            </header>
            <?= $text ?>
        </article>
      </div>
    </div>
  </div>
</div>
