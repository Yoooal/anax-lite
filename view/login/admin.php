
?>

<div class="container" role="main">
  <div class="page-header">
      <h1>Admin</h1>
  </div>
  <div class="page-content">
    <div class="row">
      <div class="col-md-12 bak">
        <br>
        <div class="col-md-6">
          <form class="" action="admin" method="post">
            <div id="custom-search-input">
                <div class="input-group col-md-12">
                    <input type="search" name="search" class="form-control input-lg" placeholder="Search username" />
                    <span class="input-group-btn">
                        <button class="btn btn-info btn-lg" type="button">
                            <i class="glyphicon glyphicon-search"></i>
                        </button>
                    </span>
                </div>
            </div>
          </form>
        </div>
        <button type="button" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#addUser">
          <i class="fa fa-user-plus" aria-hidden="true"></i>
        </button>
        <table class="table">
          <thead>
            <tr>
              <th>Username</th>
              <th>Level</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($resultset as $row) {
              if ($row->username == "admin") {

              } else {
              ?>
                <tr>
                  <td><?= $row->username ?></td>
                  <td><?= $row->userLevel ?></td>
                  <td>
                    <form role="form" method="POST">
                        <div class="form-group">
                            <select class="form-control" name="level" onchange="this.form.submit()">
                                <option>Change level here..</option>
                                <option>3</option>
                                <option>2</option>
                                <option>1</option>
                            </select>
                        </div>
                        <input type="hidden" name="id" value="<?= $row->id ?>">
                    </form>
                  </td>
                  <td>
                  <form action="admin" method="POST">
                    <input type="password" name="new_pass" placeholder="New password" required>
                    <input type="password" name="re_pass" placeholder="Re-enter Password" required>
                    <button type="submit" class="btn btn-primary" name="submitForm" value="Change password">Change Password</button>
                    <input type="hidden" name="id" value="<?= $row->id ?>">
                  </form>
                  </td>
                  <td><a type="button" class="btn btn-danger" href='?del=<?= $row->id ?>'><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
                </tr>
              <?php
              }
            }
            ?>
          </tbody>
        </table>
        </div>
        </div>
        <br>
        <div class="row">
        <div class="col-md-12 bak">
        <div class="col-md-6">
          <h2>Content</h2>
        </div>
        <br>
        <button type="button" class="btn btn-default btn-lg pull-right" data-toggle="modal" data-target="#addContent">
          <i class="fa fa-file-text-o" aria-hidden="true"></i>
        </button>
        <table class="table">
          <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Type</th>
                <th>Published</th>
                <th>Created</th>
                <th>Updated</th>
                <th>Deleted</th>
                <th>Actions</th>
            </tr>
          </thead>
        <?php $id = -1; foreach ($content as $row) :
        ?>
          <tbody>
            <tr>
                <td><?= $row->id ?></td>
                <td><?= $row->title ?></td>
                <td><?= $row->type ?></td>
                <td><?= $row->published ?></td>
                <td><?= $row->created ?></td>
                <td><?= $row->updated ?></td>
                <td><?= $row->deleted ?></td>
                <td><a type="button" class="btn btn-primary" href="edit?id=<?= $row->id ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    <a type="button" class="btn btn-danger" href="delete?id=<?= $row->id ?>"><i class="fa fa-trash-o" aria-hidden="true"></i></a></td>
            </tr>
          </tbody>
        <?php endforeach; ?>
        </table>
      </div>
    </div>
    <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Account</h4>
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
    <div class="modal fade" id="addContent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Create Content</h4>
      </div>
      <div class="modal-body">
        <form role="form" method="POST" action="">
            <div class="form-group">
              <label for="contentTitle">Title: </label>
              <input type="text" name="contentTitle" class="form-control" />
            </div>
            <button type="submit" class="btn btn-primary" name="doCreate">Add</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    </div>
    </div>
  </div>
</div>
