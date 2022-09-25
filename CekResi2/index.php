<!--Editor Gascoding-->
<!DOCTYPE html>
<html lang="">
 <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cek Resi Anda</title>

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
   <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
   <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
 </head>
 <body>
  <div class="container">
   <h2 align="center">Cek Nomor Resi</h2>
   <hr>
   <div class="col-lg-4">
    <div class="panel panel-success">
     <div class="panel-heading">Cek Resi Anda</div>
     <div class="panel-body">
      <form action="" method="post">
        <div class="form-group"> 
        <label for="" class="control-label">Contoh Kode</label>
        <p>SOCAG00183235715 - JNE</p>
       </div>
       <div class="form-group"> 
        <label for="" class="control-label">Nomor Resi</label>
        <input type="text" class="form-control" name="resi" required>
       </div>
        <div class="form-group"> 
        <label for="" class="control-label">kurir</label>
        <select class="form-control" name="kurir" required>
          <option value="jne">JNE</option>
          <option value="tiki">TIKI</option>
          <option value="wahana">Wahana</option>
          <option value="sicepat">SiCepat</option>
          <option value="PCP">Priority Cargo and Package (PCP)</option>
          <option value="pos">Pos Indonesia</option>
          <option value="rpx">RPX Holding</option>
          <option value="J&T">J&T Express</option>
          <option value="sap">SAP Express</option>
          <option value="jet">JET Express</option>
          <option value="dse">21 Express </option>
          <option value="lion">Lion Parcel</option>
          <option value="ninja">Ninja Xpress</option>
          <option value="idl">IDL Cargo</option>
          <option value="rex">Royal Express Indonesia(REX)</option>
        </select>
       </div>
     </div>
     <div class="panel-footer">
      <button type="submit" name="cek" class="btn btn-primary">Cek Resi</button>
     </div>
     </form>
    </div>
   </div>
   <div class="col-lg-8">

<?php
$agripost=0;

if(!isset($_POST['resi'])){

echo '<div class="panel panel-info">
       <div class="panel-heading">Hasil Pencarian Nomor Resi Anda</div>
       <div class="panel-body">';
echo "Belum tersedia";
echo'   </div>
    </div>';
}else{
  $agripost=$_POST['resi'];
  $kurir=$_POST['kurir'];

require ("getjson.php");

if ($err) {
  echo "cURL Error #:" . $err;
} else {
 //echo $response;
  //$data = json_decode($response, true);
//echo $data['rajaongkir']['query']['waybill'];

$data = json_decode($response, true);
//=======================================================
$agrishop = $data['rajaongkir']['query'];
$agrishop2 = $data['rajaongkir']['result'];
$agrishop3 = $data['rajaongkir']['result'];
//=============================================
  echo '<div class="panel panel-success">
     <div class="panel-heading">Pengiriman</div>
     <div class="panel-body">
    <div class="row">';
  echo '<div class="col-md-4">';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Kode Tracking</label>
        <p>'.$agrishop['waybill'].'</p>
       </div>';
   echo '<div class="form-group"> 
        <label for="" class="control-label">Kurir</label>
        <p>'.$agrishop['courier'].'</p>
       </div>';
   echo '<div class="form-group"> 
         <label for="" class="control-label">Layanan</label>
        <p>'.$agrishop2['summary']['service_code'].'</p>
       </div>';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Tanggal </label>
        <p>'.$agrishop2['details']['waybill_date'].' '.$agrishop2['details']['waybill_time'].'</p>
       </div>';
   echo '<div class="form-group"> 
        <label for="" class="control-label">Tujuan </label>
        <p>'.$agrishop2['summary']['origin'].' '.$agrishop2['summary']['destination'].'</p>
       </div>';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Samapi pada </label>
        <p>'.$agrishop2['delivery_status']['pod_date'].' '.$agrishop2['delivery_status']['pod_time'].'</p>
       </div>';
   echo '<div class="form-group"> 
        <label for="" class="control-label">Status </label>
        <p>'.$agrishop2['summary']['status'].'</p>
       </div>';
   echo '</div>';
   echo '<div class="col-md-4">';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Pengirim</label>
        <p>'.$agrishop2['summary']['shipper_name'].'</p>
       </div>';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Alamat Pengirim</label>
        <p>'.$agrishop2['details']['shipper_address1'].'</p>
       </div>';
  echo '<div class="form-group"> 
        <label for="" class="control-label">Penerima</label>
        <p>'.$agrishop2['summary']['receiver_name'].'</p>
       </div>';
   echo '<div class="form-group"> 
        <label for="" class="control-label">Alamat Penerima</label>
        <p>'.$agrishop2['details']['receiver_address1'].'</p>
       </div>';
   
   echo '</div>';
   
     echo '<div class="col-md-4">';
  echo '<div class="form-group"> 
        <label for="" class="control-label">manifest</label>
       </div>';
  for($j=0; $j < count($data['rajaongkir']['result']['manifest']); $j++)
    {$agrishop3=$data['rajaongkir']['result']['manifest'];
    echo '<div class="form-group"> 
        <label for="" class="control-label">'.$agrishop3[$j]['manifest_description'].'</label>
        <p>'.$agrishop3[$j]['manifest_date'].' '.$agrishop3[$j]['manifest_time'].'</p>
        <p>'.$agrishop3[$j]['city_name'].'</p>
       </div>';
    }
     echo '</div>';
   echo ' </div>
   </div>
  </div>';
//======================================


	}
}
?>

  <!-- jQuery -->
  <script src="//code.jquery.com/jquery.js"></script>
  <!-- Bootstrap JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
  <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
   <script src="Hello World"></script>
 </body></html>
