<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{$lang_code}"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="{$lang_code}"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="{$lang_code}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{$lang_code}"> <!--<![endif]-->
<head>

  	<meta charset="utf-8">
  	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

  	<title>Browser not Compatible</title>

	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
  	<meta name="description" content="">
  	<meta name="author" content="{$URL}humans.txt">
  	<link type="text/plain" rel="author" href="{$URL}humans.txt" />

  	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Lato:300italic,400italic,700italic">
	<link rel="stylesheet" href="{$CSS}normalize.css">
	<link rel="stylesheet" href="{$CSS}main.css">

  	<style>

  		{literal}

			#ie-message{
				padding:30px;
			}

	  		#ie-message h1{
	  			color:#666;
	  			font:bold 30px Arial, sans-serif;
	  			margin-bottom:20px;
	  		}

			#ie-message p{
				color:#666;
				font:bold 12px Arial, sans-serif;
				line-height:20px;
			}

			#ie-message ul{
				font-size:12px;
				margin:20px 0 20px 15px;
			}

				#ie-message li{
					margin-bottom:5px;
				}

		{/literal}

  	</style>

</head>

<body id="ie-message">

	<h1>Tu navegador no es compatible</h1>

	<p>Tu navegador de internet no es compatible con esta página web. Por favor, <a href="http://windows.microsoft.com/es-ES/internet-explorer/products/ie/home">actualiza</a> tu navegador <br />a la última versión o mejor aún, utiliza cualquiera de los siguientes navegadores gratuitos y superiores:</p>

	<ul>

		<li>

			<a href="http://www.mozilla.com">Mozilla Firefox</a>

		</li>

		<li>

			<a href="http://www.google.com/chrome">Google Chrome</a>

		</li>

		<li>

			<a href="http://www.opera.com/">Opera</a>

		</li>

		<li>

			<a href="http://www.apple.com/es/safari/">Safari</a>

		</li>

	</ul>

	<p><a href="http://browser-update.org/update.html" target="_blank">http://browser-update.org/update.html</a></p>


  	<script>

  		var google_analytics_code = "{$google_analytics}";

		{literal}
			var _gaq=[['_setAccount', google_analytics_code],['_trackPageview']];
		    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		    s.parentNode.insertBefore(g,s)}(document,'script'));
	    {/literal}

  	</script>

</body>
</html>
