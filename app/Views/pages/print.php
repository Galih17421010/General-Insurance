<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print - <?= $nama ?></title>
  </head>
  <body>
    <?php
      $path = 'assets/logo.jpg';
      $type = pathinfo($path, PATHINFO_EXTENSION);
      $data = file_get_contents($path);
      $imgbase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    ?>
    <img src="<?= $imgbase64 ?>" style="max-width: 45%;" />
    <h4>General Information</h4>
    <label>Nama Tertanggung &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $nama ?></label><br />
    <label>Periode Pertanggungan &nbsp; &nbsp; &nbsp; &nbsp;: <?= $periode  ?></label><br />
    <label>Pertanggungan / Kendaran &nbsp;: <?= $kendaraan  ?></label><br />
    <label>Harga Pertanggungan &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $harga  ?></label>
    <br /><br />
    <h4>Coverage Information</h4>
    <label>Jenis Pertanggungan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $jenis  ?></label><br />
    <label>Resiko Pertanggungan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?= $resiko  ?></label>
    <br /><br />
    <h4>Premium Calculation</h4>
    <label>Periode Pertanggungan &nbsp; &nbsp; &nbsp; : <?= $periode  ?></label><br />
    <label>Premi Kendaran &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $premi_kendaraan  ?>  </label><br />
    <label> <?= $resiko ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $premi_resiko  ?></label>
    <br /><br />
    <h4>Total Premi &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $total  ?></h4>
  </body>
</html>
