<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?=base_url()?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" >

    <title>Wishlist - <?=$slug?></title>
  </head>
  <body>
    <h1><?=$deskripsi?></h1>
    <hr>
    <div class="container">
    <?php $i1=0; foreach($wishlist as $r2):
    $i1 = $i1+1;  
    ?>

    <h2><?=$i1.".".$r2->kategori?></h2>
    <p><?=$r2->qt." ".$r2->satuan?></p>
    <div class="row">
    <?php 
    $qw = $db->query("SELECT * from ta_wishlist_sub2 where id_sub1 = $r2->id_sub1");
    $data_barang = $qw->getResult();
    foreach($data_barang as $r):?>
        <div class="col-3 mb-3">
        <div class="card" >
        <img src="<?=base_url()?>/img/<?=$r->img?>" class="card-img-top" alt="...">
        <div class="card-body">
            <h5 class="card-title"><?=$r->nama_barang?></h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-4">Amount</div>
                <div class="col-1">:</div>
                <div class="col-6"><?=$r->amount." ".$r->units?> </div>
                <div class="col-4">Price</div>
                <div class="col-1">:</div>
                <div class="col-6">Rp.<?=number_format($r->harga)?></div>
            </div>
            <a href="<?=$r->link?>" class="card-link">Product Link</a>
            <input class="form-check-input rd-<?=$r->id_sub1?>" type="radio" name="name-<?=$r->id_sub1?>" id="id-<?=$r->id_sub2?>">
        </div>
        </div>
        </div>
       
   <?php endforeach; ?>
   </div> 
   <?php endforeach; ?>
   </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="<?=base_url()?>/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>