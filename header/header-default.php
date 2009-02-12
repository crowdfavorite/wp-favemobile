<?php

// This file is part of the Carrington Mobile Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2009 Crowd Favorite, Ltd. All rights reserved.
// http://crowdfavorite.com
//
// Released under the GPL license
// http://www.opensource.org/licenses/gpl-license.php
//
// **********************************************************************
// This program is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
// **********************************************************************

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>
<head>
	<title><?php wp_title('&laquo;', true, 'right'); bloginfo('name'); ?></title>
	<meta http-equiv="content-type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<meta id="viewport" name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;"/>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" charset="utf-8" />
	<style type="text/css" charset="utf-8">
	@import url(<?php echo trailingslashit(get_bloginfo('template_url')).'css/advanced.css'; ?>);
	</style>
	<script type="text/javascript">
	<!--
<?php

if (function_exists('cfmobi_check_mobile')) {
	global $cfmobi_touch_browsers;
	if (count($cfmobi_touch_browsers)) {
		$touch = array();
		foreach ($cfmobi_touch_browsers as $browser) {
			$touch[] = str_replace('"', '\"', trim($browser));
		}

?>
	var CFMOBI_TOUCH = ["<?php echo implode('","', $touch); ?>"];
	for (var i = 0; i < CFMOBI_TOUCH.length; i++) {
		if (navigator.userAgent.indexOf(CFMOBI_TOUCH[i]) != -1) {
			document.write('<?php echo str_replace('/', '\/', '<link rel="stylesheet" href="'.trailingslashit(get_bloginfo('template_url')).'css/touch.css" type="text/css" media="screen" charset="utf-8" />'); ?>');
			break;
		}
	}
<?php

	}
}

?> 
	document.write('<?php

ob_start();
wp_print_scripts();
$wp_scripts = ob_get_contents();
ob_end_clean();

echo trim(str_replace(
	array("'", "\n", '/'), 
	array("\'", '', '\/'),
	$wp_scripts
));

?>');
	//--></script>
</head>
<body<?php if(is_single() || is_page()) {echo '';} else { echo ' id="is-list"';} ?>>

<h3 id="site-name"><a rel="home" href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></h3>

<hr />

<p id="navigation-top" class="navigation">
	<?php cfct_misc('main-nav'); ?>
</p>

<hr />