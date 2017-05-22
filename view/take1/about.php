<?php $urlReport = $app->url->create("status"); ?>

<div class="container" role="main">
    <div class="page-header">
        <h1>About</h1>
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="img/about.png" class="img-responsive img-thumbnail" alt="Responsive image">
      </div>
      <div class="col-md-9 well">
        <p>
          Objektorienterad PHP ska bli spännande och jag ser fram emot den här kursen!<br>
          Repo på github: <a href="https://github.com/Yoooal/anax-lite">Anax-lite</a><br>
          <a href="<?= $urlReport ?>">Status</a>
        </p>
      </div>
    </div>
</div>
