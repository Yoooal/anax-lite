<?php
$db = $app->db;

$sql = <<<EOD
SELECT
*,
CASE
    WHEN (deleted <= NOW()) THEN "isDeleted"
    WHEN (published <= NOW()) THEN "isPublished"
    ELSE "notPublished"
END AS status
FROM content
WHERE type=?
;
EOD;

$resultset = $db->executeFetchAll($sql, ["page"]);
?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Pages</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12 bak">
        <table class="table">
          <thead>
            <tr>
              <th>Id</th>
              <th>Title</th>
              <th>Type</th>
              <th>Published</th>
              <th>Deleted</th>
            </tr>
          </thead>
        <?php $id = -1; foreach ($resultset as $row) :
        ?>
        <tbody>
          <tr>
            <td><?= $row->id ?></td>
            <td><a href="pages/<?= $row->path ?>"><?= $row->title ?></a></td>
            <td><?= $row->type ?></td>
            <td><?= $row->published ?></td>
            <td><?= $row->deleted ?></td>
          </tr>
        </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>
