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
	<p><a href="<?php bloginfo('wpurl'); ?>/wp-admin/options-general.php?ak_action=reject_mobile">Exit the Mobile Edition</a> <span class="small">(view the standard browser version)</span>.</p>

	<hr />

	<p class="small">
		Proudly powered by <a href="http://wordpress.org"><strong>WordPress</strong></a> and <a href="http://carringtontheme.com"><strong>Carrington</strong></a>.<br />
		<a href="http://alexking.org/projects/wordpress">WordPress Mobile Edition</a> available at alexking.org.
	</p>
<?php
if (cfct_get_option('cfct_credit') == 'yes') {
?>
	<p id="developer-link"><?php printf(__('<a href="http://crowdfavorite.com" title="Custom WordPress development, design and backup services." rel="developer designer">%s</a>', 'carrington-mobile'), 'Carrington Theme by Crowd Favorite'); ?></p>
<?php
}
?>
	<div class="clear"></div>
</div>
<script type="text/javascript">
	document.write('<?php

ob_start();
wp_print_scripts();
$scripts = ob_get_contents();
ob_end_clean();

echo trim(str_replace(
	array("'", "\n", '/'), 
	array("\'", '', '\/'),
	$scripts
));

?>');
</script>
<?php

wp_footer();

?>
</body>
</html>