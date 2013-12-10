<?php
use Illuminate\Database\Capsule\Manager as Capsule;
include __DIR__.'/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>Starter Template for Bootstrap</title>

		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.css" rel="stylesheet">

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->

		<link href='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.css' rel='stylesheet' />
		<script src='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.js'></script>
                        <script src="https://www.mapbox.com/mapbox.js/assets/leaflet.markercluster.js" type="text/javascript"></script>
                        <script src="/points.php<?php if (isset($_GET['type'])) echo '?type='.htmlentities($_GET['type']); ?>"></script>

                        <link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.css" />
<link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.Default.css" />
<!--[if lte IE 8]>
  <link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.Default.ie.css" />
<![endif]-->
		<style>#map-basic { position:absolute; width:100%; height:100%; }</style>
	</head>

	<body>
		<div id='map-basic'></div>
  <script>
  var map = L.mapbox.map('map-basic', 'srtfisher.ggfklg22', {zoomControl: true})
     .setView([37.8, -96], 4);

    var markers = new L.MarkerClusterGroup({disableClusteringAtZoom: 8});

    for (var i = 0; i < addressPoints.length; i++) {
        var a = addressPoints[i];
        var title = a[2];
        var marker = L.marker(new L.LatLng(a[0], a[1]), {
            icon: L.mapbox.marker.icon({'marker-size': 'small', 'marker-color': a[3]}),
            title: title
        });
        marker.bindPopup(title);
        markers.addLayer(marker);
    }
    map.addLayer(markers);
</script>
	</body>
</html>
