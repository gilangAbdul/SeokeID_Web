<?php
    $id_cityTujuan = $_GET['id_city'];
    $berat = $_GET['berat'];
    $kurir = $_GET['kurir'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => "origin=154&destination=".$id_cityTujuan."&weight=".$berat."&courier=".$kurir,
    CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 5a1b3e470a2c33744e18eeac486e563d"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
    echo "cURL Error #:" . $err;
    } else {
        $data  = json_decode($response);
    }


    echo "<option> --Pilihan Layanan-- </option>";
    foreach($data -> rajaongkir -> results[0] -> costs as $ongkir){
        echo "<option value=".$ongkir -> cost[0]->value.",".$ongkir -> service."[".$ongkir -> cost[0]->etd."Hari]>".
         $ongkir -> service." [ Rp ".number_format($ongkir -> cost[0]->value,0,',','.')." ][ ".$ongkir -> cost[0]->etd." Hari]
         </option>";
    }

?>