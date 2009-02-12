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
	var tabs = $('ul.tabs');
	if (tabs.size()) {
		tabs.removeClass('hide');
		$('#recent, #pages').hide();
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
	}
});