	<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
	<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Traçar Rota</title>
	</head>
		<!--importação do jquery(js) e a api do google-->
        <script type="text/javascript"
                src=https://maps.googleapis.com/maps/api/js?key=AIzaSyAqWlqXT44tXf65hp7VK7flrnRXaTtsB2E&callback=initMap></script>
        <script type="text/javascript" src="jquery.min.js"></script>
		<style type="text/css">
			/*tamanho da área do quadrado que o mapa vai ficar*/
			body{
				width: 99%;
				height: 100%;
				background-color: grey;
			}
			/*tamanho de exibição do mapa em si*/
			#map_content {
				width: 100%;
				height: 100%;
				background-color: red;
			}
			 
			#content {
				width: 90%;
				height: 600px;
				background-color: aquamarine;
			}
			#map_content{
				text-align: center;
			}
			h2{
				margin-bottom: -13px;
			}
		</style>
		<!-- Configurações do mapa-->
		<?php
			$geo = array();
			//Corrigir CEP:
			//$cep = str_replace("-", "+-+", );
			//Endereço desejado:
			$endereco = "Dr. Antônio Prado, 446 - Centro, Ourinhos - SP, 19911-810";
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
			// -------- //
            //Corrigir CEP:
            //$cep = str_replace("-", "+-+", );
            //Endereço desejado:
            $endereco = "Centro de Ourinhos - SP";
            //Remover Acentos que prejudica link
            $enderecoN = preg_replace( '/[`^~\'"]/', null, iconv( 'UTF-8', 'ASCII//TRANSLIT', $endereco));
            //Trocar Espaços para adequar ao link
            $address = utf8_encode(str_replace(" ", "+", $enderecoN));
            //id e code para uso da API
            $app_id = 'mjE0oL5hM4jgM1DCJAgt';
            $app_code = 'TPJXy2my47PzzQV4EPqf6w';
            $geocode = file_get_contents('https://geocoder.cit.api.here.com/6.2/geocode.json?searchtext='.$address.'&app_id='.$app_id.'&app_code='.$app_code.'&gen=8');
            $output = json_decode($geocode, false);
            $geo['lati1'] = $output->Response->View[0]->Result[0]->Location->DisplayPosition->Latitude;
            $geo['long1'] = $output->Response->View[0]->Result[0]->Location->DisplayPosition->Longitude;
            $geo['loca1'] = $output->Response->View[0]->Result[0]->Location->Address->Label;
        ?>
		<script type="text/javascript">
			var map; /*objeto que recebe o mapa da API*/
			var directionsService = new google.maps.DirectionsService(); //serviço da api que calcula a rota entre os locais
			var info = new google.maps.InfoWindow({maxWidth: 200});//largura da bolha de informações do marcador

            //Cria Marcador e Determina Posição via Longitude e Latitude
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(<?php echo "'$geo[lati]', '$geo[long]'";?>)
			});
            var markerOri = new google.maps.Marker({
                position: new google.maps.LatLng(<?php echo "$geo[lati1], $geo[long1]";?>)
            });

            function initialize() {
				var options = {
					//define algumas configurações do mapa, como zoom, posição e tipo de mapa, no caso o de estrada
						zoom: 15,
						center: marker.position,
						mapTypeId: google.maps.MapTypeId.ROADMAP
				};

				map = new google.maps.Map($('#map_content')[0], options);

				marker.setMap(map);
                markerOri.setMap(map);

                //Determina conteudo que aparecera no Evento de Click do Marker
                google.maps.event.addListener(marker, 'click', function() {
					info.setContent('<?php echo "$geo[loca]";?>');
					info.open(map, marker);
				});
                google.maps.event.addListener(markerOri, 'click', function() {
                    info.setContent('<?php echo "$geo[loca1]";?>');
                    info.open(map, markerOri);
                });

			}
			//função para passar os dados do formulário = Origem e Destino
            function calcRota() {
                var directionsDisplay = new google.maps.DirectionsRenderer();
                var request = {
                    origin: markerOri.val(),
                    destination: marker.position,
                    travelMode: google.maps.DirectionsTravelMode.DRIVING
                };
                directionsService.route(request, function(response, status) {
                    if (status == google.maps.DirectionsStatus.OK) {
                        directionsDisplay.setDirections(response);
                        directionsDisplay.setMap(map);
                    }
                });
                return false;
            }
		</script>
	<!-- invoca a função initilize-->
	<body onload="initialize()">
	<div id="content"><div id="map_content"></div></div>
	</body>
	</html>