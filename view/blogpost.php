<?php
$db = $app->db;
$db->connect();
$textfilter = $app->textfilter;

$sql = $app->sqlCode->getSqlCode("blogpost");
$route = $_SERVER["PATH_INFO"];
$slug = substr($route, 6);
$content = $db->executeFetch($sql, [$slug, "post"]);

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
                <p><i>Latest update: <time datetime="<?= esc($content->published_iso8601) ?>" pubdate><?= esc($content->published) ?></time></i></p>
            </header>
            <?= $text ?>
        </article>
      </div>
    </div>
  </div>
</div>
