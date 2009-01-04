// This file is part of the Carrington Mobile Theme for WordPress
// http://carringtontheme.com
//
// Copyright (c) 2008 Crowd Favorite, Ltd. All rights reserved.
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

jQuery(function() {
	jQuery('link[rel=stylesheet]').each(function() {
		var base = jQuery(this).attr('href').replace('style.css', '');
		jQuery('head').append('<link rel="stylesheet" href="' + base + 'css/advanced.css" type="text/css" media="screen" charset="utf-8" />');
		return false;
	});
	jQuery('ul.tabs a[href=#recent]').click(function() {
		jQuery('ul.tabs li').removeClass('active');
		jQuery(this).parent().addClass('active');
		jQuery('#pages_tab').hide();
		jQuery('#recent_tab').show();
		return false;
	});
	jQuery('ul.tabs a[href=#pages]').click(function() {
		jQuery('ul.tabs li').removeClass('active');
		jQuery(this).parent().addClass('active');
		jQuery('#recent_tab').hide();
		jQuery('#pages_tab').show();
		return false;
	});
});