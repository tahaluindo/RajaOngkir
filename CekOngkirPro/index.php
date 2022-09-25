<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<?php
    $api_key = "f70a07c9eb25d5f27b81093e624ce50b";// Gak Usah Di Ganti

    function get_city($key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/city",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }

    function get_subdistrict($city_id, $key){
        $data = [
            'status' => false,
            'result' => []
        ]; 
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$city_id,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }

    function hitung_ongkir($kecamatan_asal, $kecamatan_tujuan, $kurir, $berat, $key){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/cost",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "origin=".$kecamatan_asal."&originType=subdistrict&destination=".$kecamatan_tujuan."&destinationType=subdistrict&weight=".$berat."&courier=".$kurir,
          CURLOPT_HTTPHEADER => array(
            "content-type: application/x-www-form-urlencoded",
            "key: ".$key
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
            $data['result'] = $err;
        } else {
            $result = json_decode($response, true);
            if ($result['rajaongkir']['status']['code'] == 200){
                $data['status'] = true;
                $data['result'] = $result['rajaongkir']['results'][0];
            } else {
                $data['result'] = $result['rajaongkir']['status']['description'];
            }
        }
        return $data;
    }

    //ambil data kota
    $city = [];
    $check = get_city($api_key);
    if ($check['status']){
        $city = $check['result'];
?>        
        <form method="GET">
            Kota Asal Pengiriman<br/>
            <select name="kota_asal" id="kota_asal">
                <?php
                    foreach ($city as $item):
                        echo "<option value='".$item['city_id']."'>".$item['type']." ".$item['city_name']."</option>";
                    endforeach;
                ?>
            </select>
            <br/><br/>
            Kecamatan Asal Pengiriman<br/>
            <select name="kecamatan_asal" id="kecamatan_asal">
            <?php
                $check = get_subdistrict($city[0]['city_id'],$api_key);
                if ($check['status']){
                    $subdistrict = $check['result'];
                    foreach ($subdistrict as $item):
                        echo "<option value='".$item['subdistrict_id']."'>".$item['subdistrict_name']."</option>";
                    endforeach;
                }
            ?>
            </select>
            <br/><br/><br/><br/>
            Kota Tujuan Pengiriman<br/>
            <select name="kota_tujuan" id="kota_tujuan">
                <?php
                    foreach ($city as $item):
                        echo "<option value='".$item['city_id']."'>".$item['type']." ".$item['city_name']."</option>";
                    endforeach;
                ?>
            </select>
            <br/><br/>
            Kecamatan Tujuan Pengiriman<br/>
            <select name="kecamatan_tujuan" id="kecamatan_tujuan">
            <?php
                $check = get_subdistrict($city[0]['city_id'],$api_key);
                if ($check['status']){
                    $subdistrict = $check['result'];
                    foreach ($subdistrict as $item):
                        echo "<option value='".$item['subdistrict_id']."'>".$item['subdistrict_name']."</option>";
                    endforeach;
                }
            ?>
            </select>
            <br/><br/><br/><br/>
            Kurir<br/>
            <select name="kurir">
                <option value="jne">JNE</option>
                <option value="pos">POS Indonesia</option>
                <option value="tiki">TIKI</option>
            </select>
            <br/><br/>
            Berat<br/>
            <input type=text name="berat" value=500> gram
            <br/><br/>
            <button type="submit">CEK Ongkir</button>
        </form>
<?php      
        if (isset($_GET['kota_asal'])){
            $kecamatan_asal = $_GET['kecamatan_asal'];
            $kecamatan_tujuan = $_GET['kecamatan_tujuan'];
            $kurir = $_GET['kurir'];
            $berat = $_GET['berat'];
            $ongkir = hitung_ongkir($kecamatan_asal,$kecamatan_tujuan,$kurir,$berat,$api_key);
            echo "<pre>";
            print_r($ongkir['result']);
            echo "</pre>";
        }

    } else {
        echo $check['result'];
    }
?>

<script>
    $('#kota_asal').on('change', function(){
        var city_id = $(this).val();
        var key = "<?=$api_key;?>";
        $.ajax({
            type : 'POST',
            url : 'http://rajaongkir-tools.herokuapp.com/CekOngkirPro/cek_kecamatan.php',
            data :  {'city_id' : city_id, 'key' : key},
                success: function (data) {
                    $("#kecamatan_asal").html(data);
            }
        });        
    });

    $('#kota_tujuan').on('change', function(){
        var city_id = $(this).val();
        var key = "<?=$api_key;?>";
        $.ajax({
            type : 'POST',
            url : 'http://rajaongkir-tools.herokuapp.com/CekOngkirPro/cek_kecamatan.php',
            data :  {'city_id' : city_id, 'key' : key},
                success: function (data) {
                    $("#kecamatan_tujuan").html(data);
            }
        });        
    });
</script>
