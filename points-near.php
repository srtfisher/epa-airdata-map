<?php
use Illuminate\Database\Capsule\Manager as Capsule;
include __DIR__.'/functions.php';
header('Content-type: application/javascript');

if (! isset($_GET['lat']) OR ! isset($_GET['lon'])) die('NO LAT LON');
$radius = (isset($_GET['radius'])) ? (int) $_GET['radius'] : 50;

$sites = Capsule::table('site')
	->select(Capsule::raw('( 3959 * acos( cos( radians('.$_GET['lat'].') ) * cos( radians( lat ) ) * cos( radians( lon ) - radians('.$_GET['lon'].') ) + sin( radians('.$_GET['lat'].') ) * sin( radians( lat ) ) ) ) AS distance'), 'site.*')
	->having('distance', '<', $radius)
	->orderBy('distance', 'asc')
	->get();

?>
var addressPoints = [
<?php
foreach ($sites as $k => $site) :
	$amounts = [];
	foreach (['CO2', 'CH4', 'NO2', 'SF6', 'NF3', 'HFC', 'PFC', 'HFE'] as $type)
		$amounts[$type] = (float) Capsule::table('emissions')
			->where('site_id', $site['id'])
			->where('type', $type)
			->pluck('amount');

	$html = $site['name'].'<br>';
	$amount = 0;

	foreach ($amounts as $type => $amt) :
		$amount = $amount+$amt;
		$html .= sprintf('<strong>%s Emissions</strong>: %s <br>', $type, $amt);
	endforeach;

	$color = '00CC00';

	if ($amount > 1000000)
		$color = '993366';
	elseif ($amount > 500000)
		$color = 'FF3300';
	elseif ($amount > 100000)
		$color = 'FFCC00';
	elseif ($amount > 5000)
		$color = 'CCFF66';
	?>
	[<?php echo $site['lat'].', '.$site['lon']; ?>, "<?php echo $html; ?>", "<?php echo $color; ?>"],
<?php endforeach; ?>
];