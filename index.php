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
	</head>

	<body>
		<div class="container">
			<h2>IS331 Project <small class="pull-right">By Sean Fisher</small></h2>
			<hr />
			
			<div class="row">
				<div class="col-sm-6">
					<h4>What is this project about?</h4>
					<ul>
						<li>Taking the information about environmental hazards and putting it in the hands of every individual</li>
						<li>Many people do not know the quality of the air/water/etc. around them.</li>
						<li>Looking at the progression of pollution through the years 2002-2008</li>

						<li>Taking the information about environmental hazards and putting it in the hands of every individual</li>
						<li>Many people do not know the quality of the air/water/etc. around them.</li>
						<li>Looking at the progression of pollution through the years 2002-2008</li>
					</ul>
				</div>
				<div class="col-sm-6">
					<h4>Where is the data from?</h4>
					<p class="lead"><span>The EPA’s Waste Data Set.</span></p>
					<p>There are number of different data sets they have about waste, air pollution, chemicals etc.</p>
					<p class="lead"><?php echo number_format((int) Capsule::table('site')->count()); ?> Sites</p>
					<p class="lead"><?php echo number_format((int) Capsule::table('emissions')->count()); ?> Emissions</p>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-6 col-sm-push-3">
					<h4>Functions</h4>
					<hr />
					<p class="lead">Mapping the Pollutants</p>
					<ul>
						<li>
							<h4><a href="map.php">CO2</a></h4>
							<p>Anthropogenic carbon dioxide (CO2) emissions (i.e., emissions produced by human activities) come from combustion of carbon based fuels, principally wood, coal, oil, and natural gas.</p>
						</li>
						<li>
							<h4><a href="map.php?type=CH4">CH4</a></h4>
							<p>Methane (CH4) is the second most prevalent greenhouse gas emitted in the United States from human activities. In 2011, CH4 accounted for about 9% of all U.S. greenhouse gas emissions from human activities. Methane is emitted by natural sources such as wetlands, as well as human activities such as leakage from natural gas systems and the raising of livestock.</p>
						</li>
						<li>
							<h4><a href="map.php?type=NO2">NO2</a></h4>
							<p>In 2011, nitrous oxide (N2O) accounted for about 5% of all U.S. greenhouse gas emissions from human activities. Nitrous oxide is naturally present in the atmosphere as part of the Earth's nitrogen cycle, and has a variety of natural sources. However, human activities such as agriculture, fossil fuel combustion, wastewater management, and industrial processes are increasing the amount of N2O in the atmosphere.</p>
						</li>
						<li>
							<h4><a href="map.php?type=SF6">SF6</a></h4>
							<p>Sulfur hexafluoride</p>
						</li>
						<li>
							<h4><a href="map.php?type=NF3">NF3</a></h4>
							<p>Nitrogen trifluoride</p>
						</li>
						<li><hr />
						<h4>Fluorinated Gases</h4>
						<p>Unlike many other greenhouse gases, fluorinated gases have no natural sources and only come from human-related activities. They are emitted through a variety of industrial processes such as aluminum and semiconductor manufacturing. Many fluorinated gases have very high global warming potentials (GWPs) relative to other greenhouse gases, so small atmospheric concentrations can have large effects on global temperatures. They can also have long atmospheric lifetimes--in some cases, lasting thousands of years. Like other long-lived greenhouse gases, fluorinated gases are well-mixed in the atmosphere, spreading around the world after they're emitted. Fluorinated gases are removed from the atmosphere only when they are destroyed by sunlight in the far upper atmosphere. In general, fluorinated gases are the most potent and longest lasting type of greenhouse gases emitted by human activities.</p>
						</li>
						<li>
							<h4><a href="map.php?type=HFC">HFC</a></h4>
						</li>
						<li>
							<h4><a href="map.php?type=PFC">PFC</a></h4>
						</li>
						<li>
							<h4><a href="map.php?type=HFE">HFE</a></h4>
						</li>
					</ul>
					<p class="lead"><a href="search.php">Retrieve Toxins Near your ZIP Code</a></p>
				</div>
			</div>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
