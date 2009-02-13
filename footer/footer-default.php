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

cfct_form('search');

global $post;
is_page() ? $parent = $post->ID: $parent = 0;

ob_start();
wp_list_pages('title_li=&depth=1&child_of='.$parent);
$sub_pages = ob_get_contents();
ob_end_clean();

if (!empty($sub_pages)) {
	$sub_pages = '<li><span class="title">'.__('Sub Pages', 'carrington-mobile').'</span></li>'.$sub_pages.'<li><span class="title">'.__('Top Level Pages', 'carrington-mobile').'</span></li>';
}

?>
<hr />

<div class="tabbed">
	<ul class="tabs hide">
		<li class="active"><a href="#recent">Recent Posts</a></li>
		<li><a href="#pages">Pages</a></li>
	</ul>
	<div id="recent_tab">
		<hr />
		<h2 class="table-title" id="recent"><?php _e('Recent Posts'); ?></h2>
		<ul class="disclosure table group">
			<?php wp_get_archives('type=postbypost&limit=10'); ?>
		</ul>
	</div>
	<div id="pages_tab">
		<hr />
		<h2 class="table-title" id="pages"><?php _e('Pages'); ?></h2>
		<ul class="disclosure table group">
			<?php echo $sub_pages; wp_list_pages('title_li=&depth=1'); ?>
		</ul>
	</div>
</div>

<hr />

<p id="navigation-bottom" class="navigation">
	<?php cfct_misc('main-nav'); ?>
</p>

<hr />

<?php

cfct_template_file('footer', 'bottom');

?>