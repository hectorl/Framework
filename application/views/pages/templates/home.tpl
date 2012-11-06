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

	<link rel="stylesheet" href="{$CSS}html5bp_reset.css">
	<link rel="stylesheet" href="{$CSS}styles.css">

	<script src="{$JS}libs/modernizr-2.5.3.min.js"></script>

</head>

<body>
	<!--[if lt IE 7]>{$t.ancient_browser}<![endif]-->

	<h1>Home</h1>

	<p>{$t.this_is_home_view}</p>

	<p><a href="{$URL}contacto">{$t.sample_contact_page}</a></p>

	<p>{$t.select_language} <a href="{$URL}lang/EN">{$t.english}</a> {$t.or} <a href="{$URL}lang/ES">{$t.spanish}</a></p>

	<h2>{$t.info_loaded_through_home_model}</h2>

	{section name=item loop=$items}

		<div><b>ID {$items[item].id}.</b> {$items[item].title}</div>

	{/section}

	<h2>{$t.ajax_test}</h2>

	<p><button type="button" name="btn-ajax" id="btn-ajax">{$t.click_here}</button></p>

	<div id="ajax-wrap">&nbsp;</div>

	<script>

		var URL_SITE = "{$URL}";

	</script>


	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{$JS}libs/jquery-1.7.1.min.js"><\/script>')</script>

	<script src="{$JS}plugins.js"></script>
	<script src="{$JS}main.js"></script>

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
