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
<hr />

<div class="tabbed group">
	<ul class="tabs">
		<li class="active"><a href="#recent">Recent Posts</a></li>
		<li><a href="#pages">Pages</a></li>
	</ul>
	<div id="recent_tab">
		<hr />
		<h2 id="recent"><?php _e('Recent Posts'); ?></h2>
		<ul class="disclosure table">
			<?php wp_get_archives('type=postbypost&limit=10'); ?>
		</ul>
	</div>
	<div id="pages_tab">
		<hr />
		<h2 id="pages"><?php _e('Pages'); ?></h2>
		<ul class="disclosure table">
			<?php wp_list_pages('title_li=&depth=1&child_of='.$parent); ?>
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