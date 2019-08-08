<html lang="en">

<head>

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>IPHYTEC</title> 

	{!! app('html')->style('librerias/bootstrap_3.3.6/css/bootstrap.css') !!} 

	<!-- Fonts -->

	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> 

</head>

<body>

	@yield('content') 

	<!-- Scripts -->

	{!! Html::script('librerias/bootstrap_3.3.6/js/bootstrap.min.js') !!}

</body>

</html>