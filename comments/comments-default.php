<?php

// This file is part of the Carrington Mobile Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008-2010 Crowd Favorite, Ltd. All rights reserved.
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

// If post requires a password, don't show comments.
if (post_password_required()) {
	echo '<p>' . __( 'This post is password protected. Enter the password to view any comments.', 'carrington-mobile' ) . '</p>';
	
	return;
}

// All clear? Ok, let's show comments.
if (have_comments() || comments_open()) {
?>

<h2 id="comments" class="title-divider"><span><?php comments_number(__('No Responses Yet', 'carrington-mobile'), __('One Response', 'carrington-mobile'), __('% Responses', 'carrington-mobile')) ?></span></h2>

<?php
	if (have_comments()) {
		echo '<ol class="commentlist">', wp_list_comments('callback=cfct_threaded_comment'), '</ol>';
	}
	cfct_form('comment');

	// If there are multiple comment pages, and pagination is on.
	if (get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) {
?>
		<div class="pagination">
			<span class="next"><?php previous_comments_link( __( 'Older Comments', 'carrington-mobile' ) ); ?></span>
			<span class="prev"><?php next_comments_link( __( 'Newer Comments <span class="meta-nav">&rarr;</span>', 'carrington-mobile' ) ); ?></span>
		</div> <!-- .navigation -->
<?php
	}
}
?>