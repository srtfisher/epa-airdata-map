<?php
use Illuminate\Database\Capsule\Manager as Capsule;
include __DIR__.'/functions.php';

$Reader = new SpreadsheetReader_XLSX('data.xlsx');
$Reader->ChangeSheet(5);
$count = 0;

/*array(64) {
  [0] =>
  string(11) "Facility Id"
  [1] =>
  string(6) "FRS Id"
  [2] =>
  string(13) "Facility Name"
  [3] =>
  string(4) "City"
  [4] =>
  string(5) "State"
  [5] =>
  string(8) "Zip Code"
  [6] =>
  string(7) "Address"
  [7] =>
  string(6) "County"
  [8] =>
  string(8) "Latitude"
  [9] =>
  string(9) "Longitude"
  [10] =>
  string(18) "Primary NAICS Code"
  [11] =>
  string(24) "Industry Type (subparts)"
  [12] =>
  string(31) "Total reported direct emissions"
  [13] =>
  string(29) "CO2 emissions (non-biogenic) "
  [14] =>
  string(24) "Methane (CH4) emissions "
  [15] =>
  string(30) "Nitrous Oxide (N2O) emissions "
  [16] =>
  string(14) "SF6 emissions "
  [17] =>
  string(13) "NF3 emissions"
  [18] =>
  string(13) "HFC emissions"
  [19] =>
  string(13) "PFC emissions"
  [20] =>
  string(13) "HFE emissions"
  [21] =>
  string(38) "Gases with No Listed GWP (metric tons)"
  [22] =>
  string(36) "Biogenic CO2 emissions (metric tons)"
  [23] =>
  string(21) "Stationary Combustion"
  [24] =>
  string(22) "Electricity Generation"
  [25] =>
  string(22) "Adipic Acid Production"
  [26] =>
  string(19) "Aluminum Production"
  [27] =>
  string(21) "Ammonia Manufacturing"
  [28] =>
  string(17) "Cement Production"
  [29] =>
  string(23) "Electronics Manufacture"
  [30] =>
  string(21) "Ferroalloy Production"
  [31] =>
  string(26) "Fluorinated GHG Production"
  [32] =>
  string(16) "Glass Production"
  [33] =>
  string(46) "HCFC–22 Production from HFC–23 Destruction"
  [34] =>
  string(19) "Hydrogen Production"
  [35] =>
  string(25) "Iron and Steel Production"
  [36] =>
  string(15) "Lead Production"
  [37] =>
  string(15) "Lime Production"
  [38] =>
  string(20) "Magnesium Production"
  [39] =>
  string(31) "Miscellaneous Use of Carbonates"
  [40] =>
  string(22) "Nitric Acid Production"
  [41] =>
  string(57) "Petroleum and Natural Gas Systems – Offshore Production"
  [42] =>
  string(48) "Petroleum and Natural Gas Systems – Processing"
  [43] =>
  string(62) "Petroleum and Natural Gas Systems – Transmission/Compression"
  [44] =>
  string(57) "Petroleum and Natural Gas Systems – Underground Storage"
  [45] =>
  string(49) "Petroleum and Natural Gas Systems – LNG Storage"
  [46] =>
  string(55) "Petroleum and Natural Gas Systems – LNG Import/Export"
  [47] =>
  string(24) "Petrochemical Production"
  [48] =>
  string(18) "Petroleum Refining"
  [49] =>
  string(26) "Phosphoric Acid Production"
  [50] =>
  string(28) "Pulp and Paper Manufacturing"
  [51] =>
  string(26) "Silicon Carbide Production"
  [52] =>
  string(22) "Soda Ash Manufacturing"
  [53] =>
  string(27) "Titanium Dioxide Production"
  [54] =>
  string(22) "Underground Coal Mines"
  [55] =>
  string(15) "Zinc Production"
  [56] =>
  string(19) "Municipal Landfills"
  [57] =>
  string(31) "Industrial Wastewater Treatment"
  [58] =>
  string(63) "Manufacture of Electric Transmission and Distribution Equipment"
  [59] =>
  string(26) "Industrial Waste Landfills"
  [60] =>
  string(178) "Is some CO2 collected on-site and used to manufacture other products and therefore not emitted from the affected manufacturing process unit(s)? (as reported under Subpart G or S)"
  [61] =>
  string(185) "Is some CO2 reported as emissions from the affected manufacturing process unit(s) under Subpart AA, G or P collected and transferred off-site or injected (as reported under Subpart PP)?"
  [62] =>
  string(58) "Does the facility employ continuous emissions monitoring? "
  [63] =>
  string(0) ""
}
*/
Capsule::table('site')->truncate();
Capsule::table('emissions')->truncate();

foreach ($Reader as $Row)
{
	$count++;

	if ($count <= 4) continue;
	
	$siteIndex = [];
	if (isset($siteIndex[$Row[0]])) :
		$site_id = $siteIndex[$Row[0]];
	else :
		$hasSite = Capsule::table('site')->where('facility_id', $Row[0])->first();

		if (! $hasSite) :
			$site_id = Capsule::table('site')->insertGetId([
				'facility_id' => $Row[0],
				'name' => $Row[2],
				'city' => $Row[3],
				'state' => $Row[4],
				'zip' => $Row[5],
				'address' =>$Row[8],
				'lat' => $Row[8],
				'lon' => $Row[9],
				'industry' => $Row[11],
				'monitor' => $Row[62],
			]);

		$siteIndex[$Row[0]] = $site_id;
		else :
			echo "Site exists....";
			$site_id = $hasSite['id'];
		endif;
	endif;

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'CO2',
		'amount' => (int) $Row[13],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'CH4',
		'amount' => (int) $Row[14],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'NO2',
		'amount' => (int) $Row[15],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'SF6',
		'amount' => (int) $Row[16],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'NF3',
		'amount' => (int) $Row[17],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'HFC',
		'amount' => (int) $Row[18],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'PFC',
		'amount' => (int) $Row[19],
	]);

	Capsule::table('emissions')->insert([
		'site_id' => $site_id,
		'type' => 'HFE',
		'amount' => (int) $Row[20],
	]);

	echo "Added CO2 data for ".$Row[2].PHP_EOL;
}