<?php
$db = $app->db;
$db->connect();

$sql = $app->sqlCode->getSqlCode("blog");
$resultset = $db->executeFetchAll($sql, ["post"]);

?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Blog</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-6">
        <article>
        <?php foreach ($resultset as $row) : ?>
        <section>
            <header>
                <h1><a href="blog/<?= esc($row->slug) ?>"><?= esc($row->title) ?></a></h1>
                <p><i>Published: <time datetime="<?= esc($row->published_iso8601) ?>" pubdate><?= esc($row->published) ?></time></i></p>
            </header>
            <?= esc($row->data) ?>
        </section>
        <br>
        <a class="btn btn-primary" href="blog/<?= esc($row->slug) ?>" role="button">Read More</a>
        <hr>
        <?php endforeach; ?>
        </article>
      </div>
    </div>
  </div>
</div>
