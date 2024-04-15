<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?=getenv("PUBLIC_URL")?>bootstrap/css/bootstrap.min.css" rel="stylesheet" >
    <style>
      td:nth-of-type(6) {
        display: none;
      }
      .card-input:hover {
      cursor: pointer;
      }
     
      .active{
        border-color: #28a745 !important;
        background-color: #f2f2f2;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.18), 0 3px 6px rgba(0, 0, 0, 0.23);
      }
    </style>
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
        <div class="col-lg-3 mb-3">
        <div class="card" id="id-<?=$r->id_sub2?>-card">
        <div class="card-body card-input">
        <img src="<?=getenv("PUBLIC_URL")?>img/<?=$r->img?>" class="card-img-top" alt="...">
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
            <input class="form-check-input rd-<?=$r->id_sub1?>" type="radio" value="<?=$r->harga * $r->qty ?>" data-nama="<?=$r->nama_barang?>" data-link="<?=$r->link?>" data-idtabel="td-<?=$r->id_sub1?>" onclick="sendTotable('<?=$r->harga * $r->qty?>','td-<?=$r->id_sub1?>')" name="name-<?=$r->id_sub1?>" id="id-<?=$r->id_sub2?>">
        </div>
        </div>
        </div>
       
   <?php endforeach; ?>
   </div> 
   <?php endforeach; ?>

   

    <table class="table" id="myTable">
      <thead>
        <tr>
          <th>No</th>
          <th>Material</th>
          <th>Name</th>
          <th>Qty</th>
          <th>Price</th>
          <th></th>
          <th>link</th>
        </tr>
      </thead>
      <tbody>
      <?php 
      $i2 = 0;
    foreach($wishlist as $tad):
      $i2 = $i2 +1;
   ?>
        <tr>
          <td><?=$i2?></td>
          <td><?=$tad->kategori?></td>
          <td id="td-<?=$tad->id_sub1?>n"></td>
          <td><?=$tad->qt.' '.$tad->satuan?></td>
          <td id="td-<?=$tad->id_sub1?>"></td>
          <td id="td-<?=$tad->id_sub1?>s"></td>
          <td id="td-<?=$tad->id_sub1?>l"></td>
        </tr>
  <?php endforeach; ?>
        <tfoot>
          <tr>
            <td></td>
            <td><strong>Total</strong></td>
            <td></td>
            <td></td>
            <td id="td-total"></td>
            <td></td>
            <td></td>
          </tr>
        </tfoot>
      </tbody>
    </table>
    </div> 
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?=getenv("PUBLIC_URL")?>bootstrap/js/bootstrap.bundle.min.js" ></script>

<script src="https://code.jquery.com/jquery-3.7.1.slim.min.js" integrity="sha256-kmHvs0B+OpCW5GVHUNjv9rOmY0IvSIRcf7zGUDTDQM8=" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
<script>
  function updateSubTotal() {
    $table2=jQuery('#myTable');
      var length=$table2.find('thead tr th').length;
      for(var i=1;i<length;i++){
        var sum=0;
        $table2.find('tbody tr').each(function(){
          if(!isNaN(Number(jQuery(this).find('td').eq(i).text()))){
            sum=sum+Number(jQuery(this).find('td').eq(i).text());
          }
        });
        $("#td-total").text("Rp."+ribuan(sum))
      }
  }
  function sendTotable(dt,idtb){
    $("#"+idtb).text(ribuan(dt))
    $("#"+idtb+"s").text(dt)
    updateSubTotal()
    
  }
 
  function ribuan(num)
  {
    var num_parts = num.toString().split(".");
    num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return num_parts.join(".");
  }
</script>

<script>
    $(document).ready(function () {
      $('input:radio').change(function () {//Clicking input radio
          var radioClicked = $(this).attr('id');
          //unclickRadio();
          removeActive();
          clickRadio(radioClicked);
          makeActive(radioClicked);
      });
      $(".card").click(function () {//Clicking the card
          var inputElement = $(this).find('input[type=radio]').attr('id');
          //unclickRadio();
          removeActive();
          makeActive(inputElement);
          clickRadio(inputElement);
          //alert(inputElement)
          var idtb = $(this).find('input[type=radio]').data('idtabel');
          var dt =  $(this).find('input[type=radio]').val();
          var nama = $(this).find('input[type=radio]').data('nama');
          var lnk = $(this).find('input[type=radio]').data('link');
          $("#"+idtb).text(ribuan(dt))
          $("#"+idtb+"s").text(dt)
          $("#"+idtb+"n").text(nama)
          $("#"+idtb+"l").text(lnk)
          updateSubTotal()
      });
  });


  function unclickRadio() {
      //$("input:radio").prop("checked", false);
      $("input:radio").is(":checked");

  }

  function clickRadio(inputElement) {
      $("#" + inputElement).prop("checked", true);
  }

  function removeActive() {
      $(".card").removeClass("active");
  }

  function makeActive(element) {
      $("#" + element + "-card").addClass("active");
  }
</script>
  </body>
</html>