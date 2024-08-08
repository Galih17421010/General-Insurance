<?php 
// $db      = \Config\Database::connect();
// $id = $_POST["id"];
// $builder = $db->table('policys')
//           ->select('id, nama_nasabah, periode_pertanggungan, kendaraan, harga, jenis, resiko,
//                     harga * IF ((  jenis = 1 ), 0.0015, 0.005 ) AS premi_kendaraan,
//                     harga * IF ((  resiko = 0 ), 0.0005, 0.0002 ) AS premi_resiko,
//                     (harga * IF ((  jenis = 1 ), 0.0015, 0.005 )) + ( harga * IF (( resiko = 0 ), 0.0005, 0.0002 )) AS total_premi ')
//           ->where('id', $id)
//           ->get();
// $data   = mysqli_fetch_array($builder); 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Print - <?= $nama ?></title>
  </head>
  <body>
  
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
    <label>Premi Kendaran &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;: <?= $premi_kendaraan  ?></label><br />
    <label> <?= $resiko  ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $premi_resiko  ?></label>
    <br /><br />
    <h4>Total Premi &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; : <?= $total  ?></h4>
  </body>
</html>
