<?php
$db = $app->db;

$status = '<div class="alert alert-info" role="alert">Edit here</div>';

if (hasKeyPost("doSave")) {
  //$params gets all values from getPost()
  $params = getPost([
        "contentTitle",
        "contentPath",
        "contentSlug",
        "contentData",
        "contentType",
        "contentFilter",
        "contentPublish",
        "contentId"
    ]);
    if (!$params["contentPath"]) {
    $params["contentPath"] = null;
    }
    if (!$params["contentSlug"]) {
        $params["contentSlug"] = slugify($params["contentTitle"]);
    }
    $sql = "SELECT * FROM content WHERE slug = ?;";
    $content = $db->executeFetch($sql, [$params["contentSlug"]]);
    if ($content != false) {
      $status = '<div class="alert alert-danger" role="alert">Slug already exist!</div>';
    } else {
      $id = getPost("contentId");
      $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
      $db->execute($sql, array_values($params));
      $status = '<div class="alert alert-success" role="alert">Edit saved!</div>';
    }
}

$contentId = getGet("id");

$sql = "SELECT * FROM content WHERE id = ?;";
$content = $db->executeFetch($sql, [$contentId]);
?>

<div class="container" role="main">
    <div class="page-header">
        <h1>Edit</h1>
    </div>
    <div class="col-md-6 bak">
    <br>
    <?=$status?>
    <form action="" method="POST">
      <div class="form-group">
        <label>Title:</label>
        <input type="text" name="contentTitle" class="form-control" placeholder="Title here.." value="<?= esc($content->title) ?>"/>
      </div>
      <div class="form-group">
        <label>Path:</label>
        <input type="text" name="contentPath" class="form-control" placeholder="Path here.." value="<?= esc($content->path) ?>"/>
      </div>
      <div class="form-group">
        <label>Slug:</label>
        <input type="text" name="contentSlug" class="form-control" placeholder="Slug here.." value="<?= esc($content->slug) ?>"/>
      </div>
      <div class="form-group">
        <label>Text:</label>
        <textarea name="contentData" class="form-control" rows="5"><?= esc($content->data) ?></textarea>
      </div>
      <div class="form-group">
        <label>Type:</label>
        <select name="contentType" class="form-control">
          <option>page</option>
          <option>post</option>
          <option>block</option>
        </select>
      </div>
      <div class="form-group">
        <label>Filter:</label>
        <input type="text" name="contentFilter" class="form-control" placeholder="Filter here.." value="<?= esc($content->filter) ?>"/>
        <!-- <select multiple name="contentFilter" class="form-control">
          <option>nl2br</option>
          <option>bbcode</option>
          <option>link</option>
          <option>markdown</option>
        </select> -->
      </div>
      <div class="form-group">
        <label>Publish:</label>
        <input type="datetime" name="contentPublish" class="form-control" value="<?= esc($content->published) ?>"/>
      </div>
      <input type="hidden" name="contentId" value="<?= esc($content->id) ?>">
      <button type="submit" class="btn btn-lg btn-primary btn-block" name="doSave" >Save</button>
    </form>
  </div>
</div>
