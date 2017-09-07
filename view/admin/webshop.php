<?php
$session = $app->session;
$db = $app->db;
$db->connect();

if ($session->get("name") != "admin") {
  header('Location: ' . $_SERVER['HTTP_REFERER']);
}

$sql = $app->sqlCode->getSqlCode("showWebshop");
$content = $db->executeFetchAll($sql);

?>


<div class="container" role="main">
  <div class="page-header">
      <h1>Webshop</h1>
  </div>
    <div class="page-content">
      <div class="row">
        <div class="col-md-12">
        <br>
        <button type="button" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#addWebshop">
          <i class="fa fa-file-text-o" aria-hidden="true"></i>
        </button>
        <table class="table">
          <thead>
            <tr>
                <th>#</th>
                <th>Bild</th>
                <th>Produkt</th>
                <th>Pris</th>
                <th>Kategori</th>
                <th>Lagerstatus</th>
                <th>Lagerplats</th>
            </tr>
          </thead>
        <?php $id = -1; foreach ($content as $row) :?>
          <tbody>
            <tr>
                <td><?= $row->id ?></td>
                <td><img src="<?= $row->picture ?>" class="img-responsive img-rounded webshop" alt="Responsive image"></td>
                <td><?= $row->description ?></td>
                <td><?= $row->price ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->items ?></td>
                <td><?= $row->shelf ?></td>
                <td><a type="button" class="btn btn-primary" href="editWebshop?id=<?= $row->id ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a type="button" class="btn btn-danger" href="delete?id=<?= $row->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
            </tr>
          </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="addWebshop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title" id="myModalLabel">Add product</h4>
  </div>
  <div class="modal-body">
    <form role="form" method="POST" action="handle_new_user">
        <div class="form-group">
            <label for="new_name">Username: </label>
            <input type="text" name="new_name" class="form-control" />
        </div>
        <div class="form-group">
            <label for="new_pass">Password: </label>
            <input type="password" name="new_pass" class="form-control" />
        </div>
        <div class="form-group">
            <label for="re_pass">Re-enter password: </label>
            <input type="password" name="re_pass" class="form-control" />
        </div>
        <div class="form-group">
            <label for="level">Level: </label>
            <select class="form-control" name="userLevel">
              <option>3</option>
              <option>2</option>
              <option>1</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submitCreateForm" value="Create">Add</button>
    </form>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>
</div>
</div>
