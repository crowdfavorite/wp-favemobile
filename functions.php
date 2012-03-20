<?php

// This file is part of the Carrington Mobile Theme for WordPress
// http://carringtontheme.com
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

load_theme_textdomain('carrington-mobile');

define('CFCT_DEBUG', false);
define('CFCT_PATH', trailingslashit(TEMPLATEPATH));
define('CFCT_HOME_LIST_LENGTH', 5);
define('CFCT_HOME_LATEST_LENGTH', 250);

include_once(CFCT_PATH.'carrington-core/carrington.php');

// Registering sidebars to keep Wordpress Happy
if (function_exists('register_sidebar')) {register_sidebar(array());}

$cfct_options = array(
	'cfct_about_text'
	, 'cfct_credit'
	, 'cfct_posts_per_archive_page'
	, 'cfct_wp_footer'
);

function cfct_mobile_wp() {
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		wp_enqueue_script('carrington-mobile', get_template_directory_uri().'/js/mobile.js', array('jquery'), '1.0');
		
		if ( is_singular() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}
add_action('wp', 'cfct_mobile_wp');

add_theme_support( 'automatic-feed-links' );

// If the content width is not yet set, define it as 480px. (Width of portrait mode iPhone 4)
if ( ! isset( $content_width ) ) $content_width = 480;

function cfct_archive_title() {
	if(is_author()) {
		$output = __('Posts by:');
	} elseif(is_category()) {
		$output = __('Category Archives:');
	} elseif(is_tag()) {
		$output = __('Tag Archives:');
	} elseif(is_archive()) {
		$output = __('Archives:');
	}
	$output .= ' ';
	echo $output;
}

function cfct_mobile_post_gallery_columns($columns) {
	return 1;
}
add_filter('cfct_post_gallery_columns', 'cfct_mobile_post_gallery_columns');

/**
 * Start and end an output buffer at specific actions that you specify.
 * Warning: this is a bit of a tricky thing to do, but it works in a pinch.
 * Basically, don't use this unless you really have to.
 */
class CFCT_OB_On_Action {
	protected $ob_started = false;
	protected $hooks_attached = false;
	protected $callback;
	
	public function __construct($start_action, $end_action, $callback = null, $priority = 10) {
		if ($callback === null) {
			$callback = array($this, 'callback');
		}
		
		$this->start_action = $start_action;
		$this->end_action = $end_action;
		$this->callback = $callback;
		$this->priority = $priority;
		
		$this->attach_hooks();
	}
	
	/**
	 * If you specialize this class, you can customize this function to do something
	 * with the buffer. Otherwise, just pass your callback in using the $callback param in __construct().
	 */
	public function callback($buffer) {
		// Do something...
	}
	
	/**
	 * Attach hooks for actions. Only runs once.
	 */
	protected function attach_hooks() {
		if ($this->hooks_attached === true) {
			return;
		}
		add_action($this->start_action, array($this, 'start'));
		add_action($this->end_action, array($this, 'end'));
		$this->hooks_attached = true;
	}
	
	protected function remove_hooks() {
		remove_action($this->start_action, array($this, 'start'));
		remove_action($this->end_action, array($this, 'end'));
	}
	
	public function start() {
		ob_start($this->callback);
		$this->ob_started = true;
	}
	
	public function end() {
		/* Check if this function is running before $this->start() gets a chance to run.
		This could happen if the end action passed runs before the start action. Under
		no circumstances do you want that to happen. If it does, throw a traceable error
		so we know what's going on. */
		if ($this->ob_started !== true) {
			throw new Exception("Uh-oh! Method end() ran before start(). This can happen if the end action you provided runs before the start action. Make sure you specify an end action that always runs after the start action.", 1);
		}
		ob_end_flush();
	}
}

/**
 * A collection of filters for comment_form().
 * Usage: CFCT_Comment_Form::setup();
 */
class CFCT_Comment_Form {
	public static $i18n = 'carrington-mobile';
	protected static $instance;
	protected static $hooks_attached = false;
	
	/**
	 * Singleton factory method
	 * @return object instance of CFCT_Comment_Form
	 */
	public static function get_instance() {
		if (!self::$instance) {
			self::$instance = new CFCT_Comment_Form();
		}
		return self::$instance;
	}
	
	/**
	 * Convenient factory method that instantiates single instance and
	 * attaches hooks automatically.
	 * @return object instance of CFCT_Comment_Form
	 */
	public static function setup() {
		$ins = self::get_instance();
		$ins->attach_hooks();
		return $ins;
	}
	
	/**
	 * Attach hooks to WordPress. Runs only once.
	 * @uses CFCT_OB_On_Action
	 */
	public function attach_hooks() {
		if (self::$hooks_attached === true) {
			return false;
		}
		add_action('comment_form_defaults', array($this, 'configure_args'));
		
		// Set up an output buffer so we can do string replacements on areas that aren't filterable.
		new CFCT_OB_On_Action('comment_form_before', 'comment_form_after', array($this, 'ob_callback'));
		
		self::$hooks_attached = true;
	}
	
	public function ob_callback($buffer) {

		$buffer = preg_replace('/<h3 id="reply-title">(.+)<\/h3>/', '<h3 class="title-divider"><span>$1</span></h3>', $buffer);
		
		return $buffer;
	}
	
	/**
	 * Attach to 'configure_args' hook
	 */
	public function configure_args($default_args) {
		$commenter = wp_get_current_commenter();
		$req = get_option( 'require_name_email' );
		
		$author_help = ($req ? __('(required)', self::$i18n) : '');
		$email_help = ($req ? __('(required, but never shared)', self::$i18n) : __('(never shared)', self::$i18n));
		
		$fields = array(
			'author' => self::to_input_block(__( 'Name', self::$i18n ), 'author', $commenter['comment_author'], $req, $author_help),
			'email' => self::to_input_block(__( 'Email', self::$i18n ), 'email', $commenter['comment_author_email'], $req, $email_help),
			'url' => self::to_input_block(__( 'Web', self::$i18n ), 'url', $commenter['comment_author_url'])
		);
		
		$textarea = self::to_tag('textarea', '', array(
			'name' => 'comment',
			'id' => 'comment',
			'class' => 'comment',
			'rows' => 8,
			'cols' => 40,
			'required' => 'required'
		));
		
		$comment_field = self::to_tag('p', $textarea);
		
		$html_tags = sprintf(__('You can use: %s', self::$i18n), esc_attr(allowed_tags()));
		
		$args = array(
			'fields' => $fields,
			'comment_field' => $comment_field,
			'label_submit' => __('Submit comment', self::$i18n),
			'title_reply' => __('Leave a Reply', self::$i18n),
			'title_reply_to' => __('Leave a Reply to %s', self::$i18n),
			'cancel_reply_link' => __('Cancel reply', self::$i18n),
			'comment_notes_after' => '',
			'comment_notes_before' => ''
		);
		return array_merge($default_args, $args);
	}
	
	/**
	 * Helper: Turn an array or two into HTML attribute string
	 */
	public static function to_attr($arr1 = array(), $arr2 = array()) {
		$attrs = array();
		$arr = array_merge($arr1, $arr2);
		foreach ($arr as $key => $value) {
			if (function_exists('esc_attr')) {
				$key = esc_attr($key);
				$value = esc_attr($value);
			}
			$attrs[] = $key.'="'.$value.'"';
		}
		return implode(' ', $attrs);
	}
	
	/**
	 * Helper for creating HTML tag from strings and arrays of attributes.
	 */
	public static function to_tag($tag, $text = '', $attr1 = array(), $attr2 = array()) {
		if (function_exists('esc_attr')) {
			$tag = esc_attr($tag);
		}
		$attrs = self::to_attr($attr1, $attr2);
		if ($text !== false) {
			$tag = '<'.$tag.' '.$attrs.'>'.$text.'</'.$tag.'>';
		}
		// No text == self closing tag
		else {
			$tag = '<'.$tag.' '.$attrs.' />';
		}
		
		return $tag;
	}
	
	public static function to_input_block($label, $id, $value, $req = null, $help_text = '') {
		$label_inner = self::to_tag('small', $label . ' ' . $help_text);
		$label = self::to_tag('label', $label_inner, array('for' => $id));
		
		$maybe_req = ($req ? array('required' => 'required') : array() );
		$input_defaults = array(
			'id' => $id,
			'name' => $id,
			'value' => $value,
			'type' => 'text'
		);
		$input = self::to_tag('input', false, $input_defaults, $maybe_req);
		
		return self::to_tag('p', $input . ' ' . $label);
	}
}
CFCT_Comment_Form::setup();
?>