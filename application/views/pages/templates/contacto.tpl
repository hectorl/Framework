<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{$lang_code}"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="{$lang_code}"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="{$lang_code}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{$lang_code}"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>Framework template</title>

	<meta name="viewport" content="width=device-width; initial-scale=1.0" />
  	<meta name="description" content="">
  	<meta name="author" content="{$URL}humans.txt">
  	<link type="text/plain" rel="author" href="{$URL}humans.txt" />

	<link rel="stylesheet" href="{$CSS}normalize.css">
	<link rel="stylesheet" href="{$CSS}main.css">

	<script src="{$JS}libs/modernizr-2.5.3.min.js"></script>

</head>

<body>

	<!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

	<h1>{$t.contact}</h1>

	<p><a href="{$URL}">{$t.back}</a></p>

	<p>{$t.form_sample}</p>

	<form id="contact-from" method="post" action="{$URL}contacto/send">

		<fieldset>

			<legend>{$t.fill_form}</legend>

			<ul>

				<li>

					<label>{$t.name}:</label>
					<input type="text" name="name" id="name">

				</li>

				<li>

					<label>{$t.message}:</label>
					<textarea name="msg" id="msg" rows="5" cols="10"></textarea>

				</li>

			</ul>

			<p><input type="submit" name="btn-enviar" id="btn-enviar" value="{$t.send}"></p>

		</fieldset>

	</form>

	{nocache}

		{if isset($name)}

			<h2>{$t.info_sent}</h2>

			<p><b>{$t.name}:</b> {$name}</p>
			<p><b>{$t.message}:</b></p>
			<p>{$msg|nl2br}</p>

		{/if}

	{/nocache}


	<script>

		var URL_SITE = "{$URL}";

	</script>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{$JS}vendor/jquery-1.8.2.min.js"><\/script>')</script>

	<script src="{$JS}plugins.js"></script>
	<script src="{$JS}main.js"></script>

	<!--[if lt IE 9]>

		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script>
		<script src="{$JS}libs/innershiv.js" type="text/javascript"></script>
		<script type="text/javascript">

			jQuery.ajaxSetup({

				dataFilter: function(data, dataType) {

					if (typeof innerShiv === 'function' && dataType === 'html') {

						return innerShiv(data);

					} else {

						return data;

					}//end else

				}//end dataFilter

			});//end ajaxSetup

		</script>

	<![endif]-->

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