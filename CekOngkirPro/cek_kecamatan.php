<?php
        $data = [
            'status' => false,
            'result' => []
        ]; 
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://pro.rajaongkir.com/api/subdistrict?city=".$_POST['city_id'],
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: ".$_POST['key']
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
        
        if ($data['status']){
            $subdistrict = $data['result'];
            foreach ($subdistrict as $item):
                echo "<option value='".$item['subdistrict_id']."'>".$item['subdistrict_name']."</option>";
            endforeach;
        }
?>
