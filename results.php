<?php
use Illuminate\Database\Capsule\Manager as Capsule;
include __DIR__.'/functions.php';

$zip = (isset($_GET['zip'])) ? $_GET['zip'] : NULL;
$radius = (isset($_GET['radius'])) ? (int) $_GET['radius'] : 50;
if (! $zip) die('NO ZIP');
$zipRecord = Capsule::table('zips')->where('zip', $zip)->first();
if (! $zipRecord) die('No zip found.');

// CO2 Emissions
$query = Capsule::table('site')
	->select(Capsule::raw('( 3959 * acos( cos( radians('.$zipRecord['lat'].') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$zipRecord['lng'].') ) + sin( radians('.$zipRecord['lat'].') ) * sin( radians( lat ) ) ) ) AS distance'), 'site.*')
	->having('distance', '<', $radius)
	->orderBy('distance', 'asc')
	->get();

$index = [];
if ($query) : foreach ($query as $q) $index[] = $q['id']; endif;

$amounts = [];
foreach (['CO2', 'CH4', 'NO2', 'SF6', 'NF3', 'HFC', 'PFC', 'HFE'] as $type)
	$amounts[$type] = Capsule::table('emissions')
		->whereIn('site_id', $index)
		->where('type', $type)
		->sum('amount');

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
		<style>#map-basic { width:100%; height: 600px; }</style>
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
		<![endif]-->



		<link href='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.css' rel='stylesheet' />
		<script src='//api.tiles.mapbox.com/mapbox.js/v1.5.1/mapbox.js'></script>
                        <script src="https://www.mapbox.com/mapbox.js/assets/leaflet.markercluster.js" type="text/javascript"></script>
                        <script src="/points-near.php?<?php echo http_build_query([
                        		'lat' => $zipRecord['lat'],
                        		'lon' => $zipRecord['lng'],
                        		'radius' => $radius
                        	]); ?>"></script>

                        <link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.css" />
<link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.Default.css" />
<!--[if lte IE 8]>
  <link rel="stylesheet" href="https://www.mapbox.com/mapbox.js/assets/MarkerCluster.Default.ie.css" />
<![endif]-->
	</head>

	<body>
		<div class="container">
			<h2>IS331 Project <small class="pull-right">By Sean Fisher</small></h2>
			<hr />
			<h4>Search Results For <?php echo number_format($radius); ?> Miles Around <?php echo sprintf('%s, %s', $zipRecord['city'], $zipRecord['state']); ?>...</h4>
			
			<ul>
				<?php foreach ($amounts as $type => $amount) : ?>
					<li><strong><?php echo $type; ?></strong>: <?php echo number_format($amount); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div id='map-basic'></div>

		 <script>
  var map = L.mapbox.map('map-basic', 'srtfisher.ggfklg22', {zoomControl: true})
     .setView([<?php echo $zipRecord['lat']; ?>, <?php echo $zipRecord['lng']; ?>], 8);

    //var markers = new L.MarkerClusterGroup();

    for (var i = 0; i < addressPoints.length; i++) {
        var a = addressPoints[i];
      /*  var title = a[2];
        var marker = L.marker(new L.LatLng(a[0], a[1]), {
            icon: L.mapbox.marker.icon({'marker-size': 'small', 'marker-color': a[3]}),
            title: title
        });
        marker.bindPopup(title);
        markers.addLayer(marker);
*/
	L.mapbox.markerLayer({
		// this feature is in the GeoJSON format: see geojson.org
		// for the full specification
		type: 'Feature',
		geometry: {
			type: 'Point',
			// coordinates here are in longitude, latitude order because
			// x, y is the standard for GeoJSON and many formats
			coordinates: [a[1], a[0]]
		},
		properties: {
		title: 'A Single Marker',
		description: 'Just one of me',
		// one can customize markers by adding simplestyle properties
		// http://mapbox.com/developers/simplestyle/
		'marker-size': 'small',
		'marker-color': '#' + a[3]
	}
	}).addTo(map);
    }
    console.log('Adding markers to layer...');
    map.addLayer(markers);
</script>
	</body>
</html>
