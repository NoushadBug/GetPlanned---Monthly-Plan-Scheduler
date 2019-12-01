<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="icon" href="img/vector_827_11-512.ico" type="image/x-icon" />
	<link href="https://fonts.googleapis.com/css?family=Nunito:400,700,800&display=swap" rel="stylesheet">
	<title>Get Planned</title>
	<link rel="stylesheet" href="./css/main.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<div class="header">
			<h1>welcome to GetPlanned!</h1>
			<p> plan every event of your life </p>
	
		</div>

<div class="wrapper" id = "wrapper">

		<h3>select days to set any upcoming plan</h3>			
	<div class="date-picker">
		<div class="selected-date" onclick="myFunction()"></div>
		<div class="dates">
			<div class="month">
				<div class="arrows prev-mth"><i class="fa fa-chevron-circle-left"></i></div>
				<div class="mth"></div>
				<div class="arrows next-mth"><i class="fa fa-chevron-circle-right"></i></div>
			</div>
			<div class="days"></div>
		</div>
		<div id = "myDIV" style="opacity: 0;">
		</div>
	</div>
</div>
	<script  src="./js/jquery-3.4.1.min.js"></script> 
	<script src="./js/main.js"></script>
</body>
</html>