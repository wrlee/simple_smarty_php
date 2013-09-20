<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>{block name=title}Default Title{/block}</title>
	<script src="//www.google.com/jsapi"></script>
	<script>
		google.load('jquery', '1.8.2');
	</script>
{*	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
*}	{block name=head}{/block}
</head>
<body>{block name=body}<code>{$smarty.template}</code> default body{/block}
	{block name=onReady}
	<script>
		'use strict';
		jQuery(document).ready(function ($) { // The '$' circumvents any 
			{$smarty.block.child}
		});
	</script>
	{/block}
</body>
</html>