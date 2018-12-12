<?php
    $geo = array();
    //Corrigir CEP:
    //$cep = str_replace("-", "+-+", );
    //Endereço desejado:
    $endereco = "Av. Vitalina Marcusso, 1400 - Campus Universitario, Ourinhos - SP, 19910-206";
    //Remover Acentos que prejudica link
    $enderecoN = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $endereco));
    //Trocar Espaços para adequar ao link
    $address = utf8_encode(str_replace(" ", "+", $enderecoN));
    //id e code para uso da API
    $app_id = 'mjE0oL5hM4jgM1DCJAgt';
    $app_code = 'TPJXy2my47PzzQV4EPqf6w';
    $geocode = file_get_contents('https://geocoder.cit.api.here.com/6.2/geocode.json?searchtext='.$address.'&app_id='.$app_id.'&app_code='.$app_code.'&gen=8');
    $output = json_decode($geocode, false);
        $geo['lati'] = $output->Response->View[0]->Result[0]->Location->DisplayPosition->Latitude;
        $geo['long'] = $output->Response->View[0]->Result[0]->Location->DisplayPosition->Longitude;
        $geo['loca'] = $output->Response->View[0]->Result[0]->Location->Address->Label;
    echo "<pre> Latitude: ";
    print_r($geo['lati']);
    echo "<br /> Longitude: ";
    print_r($geo['long']);
    echo "<br /> Label: ";
    print_r($geo['loca']);
    echo "<br /><br /> Resultado completo JSON: <br /><br />";
    print_r($output);
?>