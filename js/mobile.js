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

jQuery(function($) {
	$('link[rel=stylesheet]').each(function() {
		var base = $(this).attr('href').replace('style.css', '');
		$('head').append('<link rel="stylesheet" href="' + base + 'css/advanced.css" type="text/css" media="screen" charset="utf-8" />');
		return false;
	});
	$('ul.tabs a[href=#recent]').click(function() {
		$('ul.tabs li').removeClass('active');
		$(this).parent().addClass('active');
		$('#pages_tab').hide();
		$('#recent_tab').show();
		return false;
	});
	$('ul.tabs a[href=#pages]').click(function() {
		$('ul.tabs li').removeClass('active');
		$(this).parent().addClass('active');
		$('#recent_tab').hide();
		$('#pages_tab').show();
		return false;
	});
	$('#pages_tab').hide();
});