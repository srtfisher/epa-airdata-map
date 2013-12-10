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
			
			<form method="GET" action="results.php">
				<p>
					<div class="row">
						<div class="col-sm-6">
							<input name="zip" type="text" placeholder="ZIP Code..." class="form-control" />
						</div>
						<div class="col-sm-6">
							<input name="radius" type="text" placeholder="Radius in Miles..." class="form-control" />
						</div>
					</div>
				</p>
				<p><button type="submit" class="btn btn-primary">Search</button></p>
			</form>
		</div>

		<!-- Bootstrap core JavaScript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>
