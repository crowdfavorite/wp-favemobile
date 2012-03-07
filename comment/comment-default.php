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

global $post, $comment;

// Data passed through threaded callback for comment reply link
extract($data);
?>
<div class="comment" id="comment-<?php comment_ID(); ?>">
	<?php if ($comment->comment_approved == '0') : ?>
	<p><em>Your comment is awaiting moderation.</em></p>
	<?php endif; ?>

	<?php comment_text() ?>

	<p class="comment-info">by <cite><?php comment_author_link() ?></cite> on <a href="#comment-<?php comment_ID() ?>"><?php comment_date('M j, Y') ?> at <?php comment_time() ?></a> <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth'])), $comment, $post); ?> <?php edit_comment_link('e','',''); ?></small></p>
</div>
