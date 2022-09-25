<?php
//Editor Gascoding
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://pro.rajaongkir.com/api/waybill",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  //CURLOPT_POSTFIELDS => "waybill=SOCAG00183235715&courier=jne",
  CURLOPT_POSTFIELDS => "waybill=$agripost&courier=$kurir",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
    "key:f70a07c9eb25d5f27b81093e624ce50b"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
