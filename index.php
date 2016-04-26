<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" href="imgs/" type="image/png">
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/segment.min.css">
	<link rel="stylesheet" href="css/header.min.css">
	<link rel="stylesheet" href="css/maps.css">
	<link rel="stylesheet" href="css/estilos.css">
	<title>Mapa General</title>
	<script src="js/jquery-1.12.0.min.js"></script>	
	<script src="js/bootstrap.min.js"></script>	
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>
	<script src="js/gmaps.js"></script>

	<script type="text/javascript">
		var map;
		$().ready(function() {
			map = new GMaps({
				div: '#map',
				lat: 6.4,
				lng: -73,
				zoom: 6,
				scrollwheel: false,
				scaleControl: false
			});

			$.ajax({
				url: 'sedes.json',
				type: 'POST',
				dataType: 'json',
				data: {
					'sedes': ''
				},
				success: function(json){
					for (var i = 0; i < json.sedes.length; i++) { //var i -> maneja las fichas
						map.addMarker({
							lat: json.sedes[i].lat,
							lng: json.sedes[i].lng,
							title: json.sedes[i].title,
							icon: "imgs/marker_logo.png",
							infoWindow: {
								content: '<p class="info"><img src="'+json.sedes[i].img+'" class="fachada img-responsive" alt="Corpoica"></p><p class="info text-center"><strong>'+json.sedes[i].title+'</strong><br><span class="fa fa-map-marker text-success"></span> '+json.sedes[i].direccion+'<br><span class="fa fa-phone text-success"></span> '+json.sedes[i].telefono+'<br><button type="button" class="btn btn-success btn-xs" onclick="map.setCenter('+json.sedes[i].lat+','+json.sedes[i].lng+'); map.setZoom(15);"><span class="fa fa-search-plus"></span> Acercarse</button></p>'
							}
						});
						console.log(json.sedes[i].id);
					}
					console.log("bien: "+json);
				},
				error: function(json){
					console.log("mal:"+ json);
				}
			});
		});
	</script>

</head>
<body>
	<div class="container">
		<div class="row text-center">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div id="map"></div>
			</div>
			<button type="button" class="btn btn-danger" id="btnCentrarMapa" style="margin-top: 20px;" onclick="map.setCenter(6.4,-73); map.setZoom(6);"><span class="fa fa-map-marker"></span> Volver a centrar</button>
		</div>
	</div> <!-- close container --> 
</body>
</html>