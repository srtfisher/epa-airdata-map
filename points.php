<?php
use Illuminate\Database\Capsule\Manager as Capsule;
include __DIR__.'/functions.php';
header('Content-type: application/javascript');

$type = (isset($_GET['type'])) ? strtoupper(trim($_GET['type'])) : 'CO2';
?>
var addressPoints = [
<?php
$sites = Capsule::table('site')
->join('emissions', function($join) {

    $join->on('emissions.site_id', '=', 'site.id');
})
->where('emissions.type', $type)
->get();

foreach ($sites as $k => $site) :
	if ($site['amount'] <= 0) continue;
	$amount = (int) $site['amount'];

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
[<?php echo $site['lat'].', '.$site['lon']; ?>, "<?php echo sprintf('%s <br><strong>%s Emissions</strong>: %s', addslashes($site['name']), $type, number_format($amount)); ?>", "<?php echo $color; ?>"],
<?php endforeach; ?>
];