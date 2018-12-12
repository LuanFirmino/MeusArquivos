<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
    <form method="post" action="index.php">
        <fieldset>
            <legend>Criar rotas</legend>
            <div>
                <label for="txtEnderecoPartida">Endereço de partida:</label>
                <input type="text" id="txtEnderecoPartida" name="txtEnderecoPartida" />
            </div>
            <div>
                <label for="txtEnderecoChegada">Endereço de chegada:</label>
                <input type="text" id="txtEnderecoChegada" name="txtEnderecoChegada" />
            </div>
            <div>
                <input type="submit" id="btnEnviar" name="btnEnviar" value="Enviar" />
            </div>
        </fieldset>
    </form>
    <div id="mapa" style="height: 500px; width: 700px"></div>

    <script src="js/jquery.min.js"></script>
    <!-- Maps API Javascript -->
    <script type="text/javascript"
            src=https://maps.googleapis.com/maps/api/js?key=AIzaSyAqWlqXT44tXf65hp7VK7flrnRXaTtsB2E&callback=initMap></script>
    <!-- Arquivo de inicialização do mapa -->
    <script src="js/mapa.js"></script>
    <script>
        var map;
        var directionsDisplay; // Instanciaremos ele mais tarde, que será o nosso google.maps.DirectionsRenderer
        var directionsService = new google.maps.DirectionsService();

        function initialize() {
            directionsDisplay = new google.maps.DirectionsRenderer(); // Instanciando...
            var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
            var options = {
                zoom: 5,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };
            map = new google.maps.Map(document.getElementById("mapa"), options);
            directionsDisplay.setMap(map); // Relacionamos o directionsDisplay com o mapa desejado
        }

        initialize();

        $("form").submit(function(event) {
            event.preventDefault();

            var enderecoPartida = $("#txtEnderecoPartida").val();
            var enderecoChegada = $("#txtEnderecoChegada").val();

            var request = { // Novo objeto google.maps.DirectionsRequest, contendo:
                origin: enderecoPartida, // origem
                destination: enderecoChegada, // destino
                travelMode: google.maps.TravelMode.DRIVING // meio de transporte, nesse caso, de carro
            };

            directionsService.route(request, function(result, status) {
                if (status == google.maps.DirectionsStatus.OK) { // Se deu tudo certo
                    directionsDisplay.setDirections(result); // Renderizamos no mapa o resultado
                }
            });
        });
    </script>
</body>
</html>