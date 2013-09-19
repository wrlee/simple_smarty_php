<?php
/**
 * 1. Setup
 * 2. Initialize Smarty object
 * 3. Interpret URL and load template.
 */
// 1a. Setup enviroment
//error_reporting(E_ERROR | E_WARNING | E_PARSE); 
error_reporting(E_ALL|E_STRICT); 
ini_set('display_errors', '1');

// Remember path to the app implementation directory
$appPath = dirname(__FILE__).DIRECTORY_SEPARATOR;

// Smarty oversite, in case this isn't set. 
date_default_timezone_set('America/Los_Angeles');

// Find PHP classes.
set_include_path($appPath.'../Smarty');	// Include Smarty files
spl_autoload_extensions(spl_autoload_extensions().',.class.php');
spl_autoload_register();

// 1b. We're doing Smarty
$smarty = new Smarty();

// In case we want to put tempates in a subdir, called templates
if (is_dir($appPath.'templates'))
	$smarty->addTemplateDir($appPath.'templates');
$smarty->addTemplateDir($appPath);
// $smarty->setConfigDir($appPath.'configs/');

// Set up working directory: $appVarPath
$umask = umask(0);	// Allow access by diff user
$appVarPath = $appPath.'var'.DIRECTORY_SEPARATOR;
if (!is_dir($appVarPath))
	mkdir($appVarPath, 0775);
if (!is_dir($appVarPath.'templates_c/'))
	mkdir($appVarPath.'templates_c/', 0775);
umask($umask);

$smarty->setCompileDir($appVarPath.'templates_c/');
// $smarty->setCacheDir($appVarPath.'cache/');
// [END] Setup

// 2. Setup request state
if (!isset($_SERVER['SCRIPT_URL']))
	$_SERVER['SCRIPT_URL'] = $_SERVER['QUERY_STRING'] 
							? substr($_SERVER['REQUEST_URI'],0,-strlen($_SERVER['QUERY_STRING'])-1)
							: $_SERVER['REQUEST_URI'];

// Get the URL to the app's root
$urlRootPath = dirname($_SERVER['SCRIPT_NAME']);
		if ($urlRootPath != '/')	// Suffix w/'/'
			$urlRootPath .= '/';
// The part of the path after the URL root
$urlOffset = strpos($_SERVER['SCRIPT_URL'],$urlRootPath) === 0
		       ? substr($_SERVER['SCRIPT_URL'], strlen($urlRootPath))
			   : $_SERVER['SCRIPT_URL'];
$urlComponenets = explode('/',$urlOffset);

if (!isset($urlComponenets[0]) || $urlComponenets[0] == '')		// Default
	$urlComponenets[0] = 'index';

// 3. Display smarty
// Determine template name based on URL
$template = $urlComponenets[0].'.tpl';
if ($smarty->templateExists($template))
{
//	$smarty->assign('name','Ned');
	$smarty->display($template);
}
elseif (stream_resolve_include_path($urlComponenets[0].'.php'))
{
	include $urlComponenets[0].'.php';
}
else
{
	header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found', TRUE, 404);
	echo "$template not found.";
}