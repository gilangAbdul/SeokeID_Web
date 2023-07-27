<?php
    $province = $_GET['province'];
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=".$province,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 5a1b3e470a2c33744e18eeac486e563d"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      $data = json_decode($response);
    }

    echo "<option>-- Pilihan Kota --</option>";

    foreach ($data -> rajaongkir -> results as $kota){
        echo '<option value="'.$kota->city_id.'">'.$kota -> city_name.'</option>';
    }
?>