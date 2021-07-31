<?php
/**
 * My theme Theme Customizer
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function mytheme_customise_register( $wp_customize ) {
    $wp_customize->remove_section( 'custom_css' );

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'mytheme_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'mytheme_customize_partial_blogdescription',
			)
		);
	}

	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	/* Sections for Kirki Fields */
	$wp_customize->add_section( "copyright" , array(
		'title'      => __( "Copyright Info", 'mytheme'),
		'priority'   => 30,
	) );

	$wp_customize->add_section( "contact_details" , array(
		'title'      => __( "Contact Details", 'mytheme'),
		'priority'   => 30,
	) );

	$wp_customize->add_panel( "home_page" , array(
		'title'      => __( "Home page", 'mytheme'),
		'priority'   => 30,
	) );

	$wp_customize->add_panel( "theme_fields" , array(
		'title'      => __( "Theme Fields", 'mytheme'),
		'priority'   => 30,
	) );

	// Uncomment for call to action (and kirki fields below)
	// $wp_customize->add_section( "call_to_action" , array(
	// 	'title'      => __( "Call to action", 'mytheme'),
	// 	'priority'   => 30,
	// 	'panel'      => 'home_page',
	// ) );
}
	
add_action( 'customize_register', 'mytheme_customise_register' );

function kirki_fields() {
	if ( ! class_exists( 'Kirki' ) ) {
		return;
	}

	Kirki::add_config( 'copyright', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_field( 'copyright', [
		'type'        => 'text',
		'settings'    => 'copyright-text',
		'label'       => esc_html__( 'Copyright Text', 'mytheme'),
		'section'     => 'copyright',
		'default'     => '&copy; YYYY '.get_bloginfo('name'),
	] );

	Kirki::add_config( 'contact_details', array(
		'capability'    => 'edit_theme_options',
		'option_type'   => 'theme_mod',
	) );

	Kirki::add_field( 'contact_details', [
		'type'        => 'editor',
		'settings'    => 'address',
		'label'       => esc_html__( 'Address', 'mytheme'),
		'section'     => 'contact_details'
	] );

	Kirki::add_field( 'contact_details', [
		'type'        => 'text',
		'settings'    => 'phone',
		'label'       => esc_html__( 'Phone Number', 'mytheme'),
		'section'     => 'contact_details'
	] );

	// Kirki::add_field( 'call_to_action', [
	// 	'type'        => 'text',
	// 	'settings'    => 'calltoaction-header',
	// 	'label'       => esc_html__( 'Call to action title', 'mytheme'),
	// 	'section'     => 'call_to_action'
	// ] );

	// Kirki::add_field( 'call_to_action', [
	// 	'type'        => 'editor',
	// 	'settings'    => 'calltoaction-content',
	// 	'label'       => esc_html__( 'Call to action content', 'mytheme'),
	// 	'section'     => 'call_to_action'
	// ] );

	// Kirki::add_field( 'call_to_action', [
	// 	'type'        => 'text',
	// 	'settings'    => 'calltoaction-button-text',
	// 	'label'       => esc_html__( 'Call to action button text', 'mytheme'),
	// 	'section'     => 'call_to_action'
	// ] );

	// Kirki::add_field( 'call_to_action', [
	// 	'type'        => 'link',
	// 	'settings'    => 'calltoaction-button-link',
	// 	'label'       => esc_html__( 'Call to action button link', 'mytheme'),
	// 	'section'     => 'call_to_action'
	// ] );

	Kirki::add_field( 'contact_details', [
	 	'type'        => 'text',
		'settings'    => 'mobile',
		'label'       => esc_html__( 'Mobile Number', 'mytheme'),
		'section'     => 'contact_details'
	] );

	//Use Icomoon to update the font
	mytheme_icon_list('social-links', 'Social Links', get_template_directory()."/assets/fonts/social/social.svg", 'contact_details');

	Kirki::add_field( 'title_tagline', [
		'type'        => 'checkbox',
		'settings'    => 'has_footerlogo',
		'label'       => esc_html__( 'Display logo in footer', 'mytheme'),
		'section'     => 'title_tagline',
		'default'     => false
	] );
}

kirki_fields();

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function mytheme_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function mytheme_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Render the an icon list
 *
 * @return void
 */

function mytheme_icon_list($slug, $name, $iconfile, $section) {
	//Get icon list
	$svg = file_get_contents($iconfile);
	$re = '/glyph-name="([^"]*)"/m';
	preg_match_all($re, $svg, $matches, PREG_SET_ORDER);
	$iconlist = ['None'];
	foreach ($matches as $match) {
		$iconlist[$match[1]] = ucfirst($match[1]);
	}
	
	Kirki::add_field( "$slug-list", [
		'type'        => 'repeater',
		'label'       => esc_html__( $name, 'mytheme'),
		'section'     => $section,
		'priority'    => 10,
		'row_label' => [
			'type'  => 'field',
			'value' => esc_html__( 'Link', 'mytheme'),
			'field' => 'icon_text',
		],
		'button_label' => esc_html__('New Link', 'mytheme'),
		'settings'     => "$slug-list",
		'default'      => [],
		'fields' => [
			'icon_text' => [
				'type'        => 'text',
				'label'       => esc_html__( 'Link Name', 'mytheme'),
				'default'     => '',
			],
			'icon_url'  => [
				'type'        => 'link',
				'label'       => esc_html__( 'Link URL', 'mytheme'),
				'default'     => '',
			],
			'icon'  => [
				'type'        => 'select',
				'label'       => esc_html__( 'Icon', 'mytheme'),
				'description' => esc_html__( 'Choose the icon to use', 'mytheme'),
				'default'     => 'generic',
				'choices'     => $iconlist,
			],
			'new_window'  => [
				'type'        => 'checkbox',
				'label'       => esc_html__( 'Navigate without closing '.get_bloginfo('name'), 'mytheme'),
				'default'     => true
			],
		]
		
	] );
}