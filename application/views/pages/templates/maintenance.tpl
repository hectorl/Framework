<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="{$lang_code}"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8" lang="{$lang_code}"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9" lang="{$lang_code}"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="{$lang_code}"> <!--<![endif]-->
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>{$t.maintenance}</title>

	<meta name="viewport" content="width=device-width" />
  	<meta name="description" content="">
  	<meta name="author" content="{$URL}humans.txt">
  	<link type="text/plain" rel="author" href="{$URL}humans.txt" />

	<style>

		{literal}

			body { text-align: center;}
			h1 { font-size: 50px; text-align: center }
			span[frown] { transform: rotate(90deg); display:inline-block; color: #bbb; }
			body { font: 20px Constantia, 'Hoefler Text',  "Adobe Caslon Pro", Baskerville, Georgia, Times, serif; color: #999; text-shadow: 2px 2px 2px rgba(200, 200, 200, 0.5); }
			::-moz-selection{ background:#FF5E99; color:#fff; }
			::selection { background:#FF5E99; color:#fff; }
			article {display:block; text-align: left; width: 500px; margin: 0 auto; }

			a { color: rgb(36, 109, 56); text-decoration:none; }
			a:hover { color: rgb(96, 73, 141) ; text-shadow: 2px 2px 2px rgba(36, 109, 56, 0.5); }

		{/literal}

	</style>
</head>

<body>

	<!--[if lt IE 8]>{$t.ancient_browser}<![endif]-->

	<article>

		<h1>{$t.maintenance}</h1>
		<div>
			<p>{$t.page_not_active}</p>
		</div>

	</article>

</body>
</html>