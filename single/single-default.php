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

get_header();

?>
<p id="next-prev-top" class="pagination"><?php cfct_misc('nav-single'); ?></p>

<div id="content" class="group">
<?php

cfct_loop();

comments_template();

?>
</div><!--#content-->

<p id="next-prev-bottom" class="pagination"><?php cfct_misc('nav-single'); ?></p>

<?php 

get_footer();

?>