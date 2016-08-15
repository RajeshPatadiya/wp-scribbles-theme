<?php

/**
 * Move some elements around.
 *
 * @action template_redirect
 * @since  1.0.0
 */
function scribbles_move_elements() {

	// Hero image
	remove_action( 'primer_header', 'primer_add_hero' );
	add_action( 'primer_after_header', 'primer_add_hero' );

	// Page titles
	remove_action( 'primer_after_header', 'primer_add_page_title' );

	if ( ! is_front_page() ) {

		add_action( 'primer_hero', 'primer_add_page_title' );

	}

}
add_action( 'template_redirect', 'scribbles_move_elements' );

/**
 * Set hero element style attribute.
 *
 * @filter primer_hero_style_attr
 * @since  1.0.0
 *
 * @return string
 */
function scribbles_hero_style_attr() {

	return sprintf(
		'background: url(%s) no-repeat bottom center; background-size: cover;',
		primer_get_hero_image()
	);

}
add_filter( 'primer_hero_style_attr', 'scribbles_hero_style_attr' );

/**
 * Display site search in the header.
 *
 * @action primer_header
 * @since  1.0.0
 */
function scribbles_add_header_search() {

	get_template_part( 'templates/parts/search' );

}
add_action( 'primer_header', 'scribbles_add_header_search', 20 );

/**
 * Display author avatar over the post thumbnail.
 *
 * @action primer_after_post_thumbnail
 * @since  1.0.0
 */
function scribbles_add_author_avatar() {

	?>
	<div class="avatar-container">

		<?php echo get_avatar( get_the_author_meta( 'user_email' ), '128' ); ?>

	</div>
	<?php

}
add_action( 'primer_after_post_thumbnail', 'scribbles_add_author_avatar' );

/**
 * Add a footer menu.
 *
 * @filter primer_nav_menus
 * @since  1.0.0
 *
 * @param  array $nav_menus
 *
 * @return array
 */
function scribbles_nav_menus( $nav_menus ) {

	$nav_menus['footer'] = esc_html__( 'Footer Menu', 'scribbles' );

	return $nav_menus;

}
add_filter( 'primer_nav_menus', 'scribbles_nav_menus' );

/**
 * Set images sizes.
 *
 * @filter primer_image_sizes
 * @since  1.0.0
 *
 * @param  array $sizes
 *
 * @return array
 */
function scribbles_image_sizes( $sizes ) {

	$sizes['primer-hero']['width']  = 2400;
	$sizes['primer-hero']['height'] = 1300;

	return $sizes;

}
add_filter( 'primer_image_sizes', 'scribbles_image_sizes' );

/**
 * Set custom logo args.
 *
 * @filter primer_custom_logo_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function scribbles_custom_logo_args( $args ) {

	$args['width']  = 325;
	$args['height'] = 80;

	return $args;

}
add_filter( 'primer_custom_logo_args', 'scribbles_custom_logo_args' );

/**
 * Set custom header args.
 *
 * @action primer_custom_header_args
 * @since  1.0.0
 *
 * @param  array $args
 *
 * @return array
 */
function scribbles_custom_header_args( $args ) {

	$args['width']  = 2400;
	$args['height'] = 1300;

	return $args;

}
add_filter( 'primer_custom_header_args', 'scribbles_custom_header_args' );

/**
 * Register sidebar areas.
 *
 * @filter primer_sidebars
 * @since  1.0.0
 *
 * @param  array $sidebars
 *
 * @return array
 */
function scribbles_sidebars( $sidebars ) {

	$sidebars['footer-4'] = array(
		'name'          => esc_html__( 'Footer 4', 'scribbles' ),
		'description'   => esc_html__( 'This sidebar is the fouth column of the footer widget area.', 'scribbles' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	);

	$sidebars['hero'] = array(
		'name'          => esc_html__( 'Hero', 'scribbles' ),
		'description'   => esc_html__( 'Hero widgets appear over the header image on the front page.', 'scribbles' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	);

	return $sidebars;

}
add_filter( 'primer_sidebars', 'scribbles_sidebars' );

/**
 * Set font types.
 *
 * @filter primer_font_types
 * @since  1.0.0
 *
 * @param array $font_types
 *
 * @return array
 */
function scribbles_font_types( $font_types ) {

	$overrides = array(
		'header_font' => array(
			'default' => 'Architects Daughter',
			'css'     => array(
				'h1,
				h2,
				h3,
				h4,
				h5,
				h6,
				label,
				legend,
				table th,
				dl dt,
				.site-title,
				.entry-title,
				.widget-title,
				button,
				a.button,
				a.fl-button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.main-navigation ul li a' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'primary_font' => array(
			'default' => 'Raleway',
			'css'     => array(
				'body,
				p,
				ol li,
				ul li,
				dl dd,
				.fl-callout-text' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
		'secondary_font' => array(
			'default' => 'Raleway',
			'css'     => array(
				'blockquote,
				.entry-meta,
				.entry-footer,
				.comment-list li .comment-meta .says,
				.comment-list li .comment-metadata,
				.comment-reply-link,
				#respond .logged-in-as' => array(
					'font-family' => '"%1$s", sans-serif',
				),
			),
		),
	);

	return primer_array_replace_recursive( $font_types, $overrides );

}
add_filter( 'primer_font_types', 'scribbles_font_types' );

/**
 * Set colors.
 *
 * @filter primer_colors
 * @since  1.0.0
 *
 * @param  array $colors
 *
 * @return array
 */
function scribbles_colors( $colors ) {

	$overrides = array(
		'header_textcolor' => array(
			'default' => '#fca903',
		),
		'background_color' => array(
			'default' => '#ffffff',
		),
		'header_background_color' => array(
			'default' => '#ffffff',
		),
		'menu_background_color' => array(
			'default' => '#78ae3e',
		),
		'footer_background_color' => array(
			'default' => '#3787da',
			'css'     => array(
				'.footer-widget .widget-title,
				.footer-widget .widget .search-field' => array(
					'border-color' => '%1$s',
				),
				'.footer-widget .widget-title' => array(
					'color' => '%1$s',
				),
			),
		),
		'tagline_text_color' => array(
			'default' => '#6f6f6f',
			'css'     => array(
				'.site-search-wrapper .widget .search-field' => array(
					'color' => '%1$s',
				),
			),
			'rgba_css'     => array(
				'.site-search-wrapper .widget .search-field' => array(
					'border-color' => 'rgba(%1$s, 0.25)',
				),
			),
		),
		'menu_text_color' => array(
			'label'   => esc_html__( 'Menu Text Color', 'scribbles' ),
			'default' => '#ffffff',
			'css'     => array(
				'.main-navigation li a' => array(
					'color' => '%1$s',
				),
				'.main-navigation-container:before,
				.main-navigation-container:after,
				.menu-toggle div' => array(
					'background-color' => '%1$s',
				),
			),
			'rgba_css' => array(
				'.main-navigation li a:hover,
				.main-navigation li a:visited:hover,
				.main-navigation .current_page_item > a,
				.main-navigation .current-menu-item > a,
				.main-navigation .current_page_ancestor > a,
				.main-navigation .current-menu-ancestor > a' => array(
					'color' => 'rgba(%1$s, 0.75)',
				),
			),
		),
		'link_color' => array(
			'default' => '#3787da',
		),
		'main_text_color' => array(
			'default' => '#404040',
		),
		'secondary_text_color' => array(
			'default' => '#686868',
		),
	);

	return primer_array_replace_recursive( $colors, $overrides );

}
add_filter( 'primer_colors', 'scribbles_colors' );
