<?php

// This file is part of the FaveMobile Theme for WordPress
//
// Copyright (c) 2008-2012 Crowd Favorite, Ltd. All rights reserved.
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

$about_text = cfct_about_text();
if (!empty($about_text)) {
?>
<div id="about" class="group">
	<h3><?php printf(__('About %s', 'carrington-mobile'), get_bloginfo('name')); ?></h3>
<?php
	echo $about_text;
?>
</div>
<?php
}
?>
<div id="footer">
<?php
if (function_exists('cfmobi_mobile_exit')) {
	cfmobi_mobile_exit();
}
?>

	<hr />

	<p class="small">
		<?php _e('Proudly powered by <a href="http://wordpress.org/" rel="generator">WordPress</a> and <a href="http://crowdfavorite.com/wordpress/carrington/">Carrington</a>.', 'carrington-mobile');  wp_loginout(); wp_register(' | ', ''); ?>
<?php
if (function_exists('cfmobi_mobile_exit')) {
?>
		<br /><a href="http://crowdfavorite.com/wordpress">WordPress Mobile Edition</a> available from Crowd Favorite.
<?php
}
?>
	</p>
<?php
if (cfct_get_option('cfct_credit') == 'yes') {
?>
	<p id="developer-link">?php printf(__('<a href="http://crowdfavorite.com/wordpress/themes/favemobile/">%s</a> by <a href="http://crowdfavorite.com" title="Custom WordPress development, design and consulting services." rel="developer designer">%s</a>', 'carrington-mobile'), 'FaveMobile', 'Crowd Favorite'); ?></p>
<?php
}
?>
	<div class="clear"></div>
</div>
<?php

wp_footer();

?>
</body>
</html>