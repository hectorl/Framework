<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{$lang_code}"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="{$lang_code}"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="{$lang_code}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{$lang_code}"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Framework template</title>

	<meta name="description" content="">

	<meta name="viewport" content="width=device-width; initial-scale=1.0" />

	<link rel="stylesheet" href="{$CSS}html5bp_reset.css">
	<link rel="stylesheet" href="{$CSS}styles.css">

	<script src="{$JS}libs/modernizr-2.5.3.min.js"></script>

</head>

<body>
	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<h1>Home</h1>

	<p>Esta es la vista de la home.</p>

	<p><a href="{$URL}contacto">Ejemplo de página de contacto</a></p>

	<h2>Esta es la información cargada a través del modelo de la home:</h2>

	<h2>Prueba a cargar algo por AJAX:</h2>

	<p><button type="button" name="btn-ajax" id="btn-ajax">Haz click aquí!</button></p>

	<div id="ajax-wrap">&nbsp;</div>

	<script>

		//Variable global a la que pasamos la URL del site para usarla en todos los js
		var URL_SITE = "{$URL}";

	</script>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{$JS}libs/jquery-1.7.1.min.js"><\/script>')</script>

	<script src="{$JS}plugins.js"></script>
	<script src="<{$JS}main.js"></script>

	<!--[if lt IE 9]>

		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
		<script src="{$JS}libs/innershiv.js" type="text/javascript"></script>
		<script type="text/javascript">
			{literal}
				jQuery.ajaxSetup({

					dataFilter: function(data, dataType) {

						if (typeof innerShiv === 'function' && dataType === 'html') {

							return innerShiv(data);

						} else {

							return data;

						}//end else

					}//end dataFilter

				});//end ajaxSetup
			{/literal}
		</script>

	<![endif]-->

  	<script>
  		{literal}
		    var _gaq=[['_setAccount',''],['_trackPageview']];
		    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
		    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
		    s.parentNode.insertBefore(g,s)}(document,'script'));
	    {/literal}
  	</script>

</body>
</html>
