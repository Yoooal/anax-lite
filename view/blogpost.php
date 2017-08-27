<?php
$db = $app->db;
$textfilter = $app->textfilter;

$sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
slug = ?
AND type = ?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;

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
