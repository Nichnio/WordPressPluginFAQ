<?php

/**
 * Plugin Name: WordpressPluginFAQ
 * Plugin URI: https://www.onebyte.ch/
 * Description: "Plug-In" to create your own faq's
 * Version: 1.0
 * Author: Nicolas Lars Friedrich Suter
 * Author URI: http://www.onebyte.ch/
 * Text Domain: WordpressPluginFAQ
 * Domain Path: /languages/
 */

// Prevent direct access to PHP through url
defined( 'ABSPATH' ) or die;

// Checks if a class is defined
if ( ! class_exists( 'acf' ) ) {

// Define path and URL to the ACF plugin.
    define( 'MY_ACF_PATH', plugin_dir_path( __FILE__ ) . '/includes/acf/' );
    define( 'MY_ACF_URL', plugin_dir_url( __FILE__ ) . '/includes/acf/' );

// Include the ACF plugin.
    include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
    add_filter( 'acf/settings/url', 'my_acf_settings_url' );
    function my_acf_settings_url( $url ) {
        return MY_ACF_URL;
    }

    //  Hide the ACF admin menu item.
    add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
    function my_acf_settings_show_admin($show_admin)
    {
        return false;
    }
}


add_action( 'acf/init', function() {
    // adds fieldgroup generated with ACF Plug-In
    acf_add_local_field_group( [
        'key'                   => 'group_5ea922b5c5d52',
        'title'                 => 'FAQ',
        'fields'                => [
            [
                'key'               => 'field_5ea92305514e5',
                'label'             => 'Frage',
                'name'              => 'frage',
                'type'              => 'text',
                'instructions'      => '',
                'required'          => 1,
                'conditional_logic' => 0,
                'wrapper'           => [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'default_value'     => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
                'maxlength'         => '',
            ],
            [
                'key'               => 'field_5ea92383514e6',
                'label'             => 'Antwort',
                'name'              => 'antwort',
                'type'              => 'text',
                'instructions'      => '',
                'required'          => 1,
                'conditional_logic' => 0,
                'wrapper'           => [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'default_value'     => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
                'maxlength'         => '',
            ],
            [
                'key'               => 'field_5ea9239c514e7',
                'label'             => 'Autor',
                'name'              => 'autor',
                'type'              => 'text',
                'instructions'      => '',
                'required'          => 0,
                'conditional_logic' => 0,
                'wrapper'           => [
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ],
                'default_value'     => '',
                'placeholder'       => '',
                'prepend'           => '',
                'append'            => '',
                'maxlength'         => '',
            ],
        ],
        'location'              => [
            [
                [
                    'param'    => 'post_type',
                    'operator' => '==',
                    'value'    => 'faq',
                ],
            ],
        ],
        'menu_order'            => 0,
        'position'              => 'normal',
        'style'                 => 'default',
        'label_placement'       => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen'        => '',
        'active'                => true,
        'description'           => '',
    ] );

} );

// initialise variable to hide post type in admin menu
$show_faq = false;

// Executes after WordPress has finished loading (before headers are sent)
add_action( 'init', 'create_faq_post_type' );

function create_faq_post_type() {

    // WordPress function (If current user is administrator or editor)
    if ( current_user_can( 'administrator') || current_user_can('editor')) {

        // initialise variable to hide post type in admin menu
        $show_faq = true;
    }
    // register post type
    register_post_type( 'faq',
        [
            'labels'             => [
                'name'              => __( 'FAQ' ),
                'singular_name'     => __( 'FAQ' ),
                'add_new'           => __( 'Neues FAQ hinzufügen' ),
                'add_new_item'      => __( 'Neues FAQ hinzufügen' ),
                'edit_item'         => __( 'FAQ bearbeiten' ),
                'all_items'         => __( 'Übersicht' ),
                'view_item'         => __( 'Ansehen der FAQs' ),
                'search_items'      => __( 'Nach FAQs Suchen' ),
                'add_theme_support' => __( 'post-thumbnails' ),
            ],
            'publicly_queryable' => true,
            'show_ui'            => $show_faq,
            'query_var'          => true,
            'has_archive'        => true,
            'hierarchical'       => false,
            'capability_type'    => 'post',
            'taxonomies'         => [ 'faq' ],
            'public'             => true,
            'rewrite'            => [ 'slug' => 'faq' ],
            'supports'           => [ 'title', 'thumbnail' ],
        ]
    );
}

// Create categories
add_action( 'init', 'create_faq_category' );
function create_faq_category() {
    register_taxonomy(
        'faq_kategorien',
        'faq',
        [
            'label'        => __( 'FAQ-Kategorien' ),
            'add_new'      => __( 'Neue FAQ Kategorie hinzufügen' ),
            'add_new_item' => __( 'Neue FAQ Kategorie hinzufügen' ),
            'rewrite'      => [ 'slug' => 'faq-kategorien' ],
            'hierarchical' => true,
        ]
    );
}



// include shortcode
include_once 'shortcode.php';

