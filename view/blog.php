<?php
$db = $app->db;

$sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
ORDER BY published DESC
;
EOD;

$resultset = $db->executeFetchAll($sql, ["post"]);

?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Blog</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12 bak">
        <article>
        <?php foreach ($resultset as $row) : ?>
        <section>
            <header>
                <h1><a href="blog/<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
                <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
            </header>
            <?= esc($row->data) ?>
        </section>
        <?php endforeach; ?>
        </article>
      </div>
    </div>
  </div>
</div>
