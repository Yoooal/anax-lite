<?php
$db = $app->db;
$db->connect();
$urlReport = $app->url->create("status");

$sql = $app->sqlCode->getSqlCode("aboutText");
$content = $db->executeFetch($sql, ["aboutText", "block"]);

?>

<div class="container" role="main">
    <div class="page-header">
        <h1>About</h1>
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="img/profil.jpg" class="img-responsive aboutPicture" alt="Responsive image">
      </div>
      <div class="col-md-9 bak">
        <br>
        <h3>Joel Pettersson</h3>
        Hej mitt namn är Joel Pettersson.
        Jag är 29 år och bor i Stockholm.
        Är uppväxt i Göteborg men flyttade till Stockholm för
        ungefär två år sedan, och trivs hittills bra i storstan.
        Har precis påbörjat en ny utbildning inom webbprogrammering på
        Blekinge Tekniska Högskola och ser fram emot vad kursen har
        att erbjuda mig!
        För övrigt är jag en glad, positiv och social kille som gillar
        att möta nytt folk och umgås med mina vänner.
        Det var kul att ni kom in på min hemsida.
        Hoppas ni gillar den!<br>
        Repo på github: <a href="https://github.com/Yoooal/anax-lite">Anax-lite</a>
        <br>
        <a href="<?= $urlReport ?>">Status</a>
      </div>
      <div class="col-md-9 bak">
        <br>
        <?= $content->data ?>
      </div>
    </div>
</div>
