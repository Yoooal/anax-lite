<?php
$db = $app->db;
$textfilter = $app->textfilter;

$sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
path = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
;
EOD;

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
