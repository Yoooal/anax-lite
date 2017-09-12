<?php
$db = $app->db;
$db->connect();

$contentId = getPost("contentId") ?: getGet("id");
if (!is_numeric($contentId)) {
    die("Not valid for content id.");
}

if (hasKeyPost("doDelete")) {
    $contentId = getPost("contentId");
    $sql = "UPDATE anax_content SET deleted=NOW() WHERE id=?;";
    $db->execute($sql, [$contentId]);
    header("Location: admin");
    exit;
}

$sql = "SELECT id, title FROM anax_content WHERE id = ?;";
$content = $db->executeFetch($sql, [$contentId]);

?>

<div class="container" role="main">
    <div class="page-header">
        <h1>Delete</h1>
    </div>
    <div class="col-md-6 bak">
    <br>
    <form action="" method="POST">
      <div class="form-group">
        <label>Delete:</label>
        <input type="text" name="contentTitle" class="form-control" value="<?= esc($content->title) ?>" readonly/>
      </div>
      <input type="hidden" name="contentId" value="<?= esc($content->id) ?>"/>
      <button type="submit" class="btn btn-lg btn-danger btn-block" name="doDelete"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
    </form>
  </div>
</div>
