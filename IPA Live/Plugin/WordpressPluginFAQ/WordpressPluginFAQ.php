<?php

/**
 * Plugin Name: WordpressPluginFAQ
 * Plugin URI:
 * Description: This Plugin was created during my IPA
 * Version: 0.1
 * Author: Nicolas Lars Friedrich Suter
 * Author URI: http://www.onebyte.ch/
 */
$args = array(
    'post_type'      => 'faq', // Custom post type Name
    'posts_per_page' => '50', // Max Post per Page
    'order_by'       => 'date', // How to Order. date
    'order'          => 'ASC', // Ascending
);

echo '<h1 class="title">FAQs</h1>'.
    '<div class="flex-container">';

$new_query = new WP_Query ( $args );
if ( $new_query->have_posts() ) { // If there are Posts
    while ( $new_query->have_posts() ) { // While there are Posts
        $new_query->the_post();
        $question   = get_field( "question" );
        $answer    = get_field( "answer" );
        $author     = get_field( "author" );


        if($firstname) {
            echo $firstname;
        }

        echo '<div class="sep">' .
            '<table style="text-align: center;" class="border">' .
            '<td>' .
            '<tr>';
        if ( is_string( $question ) && strlen( $question ) && is_string( $answer ) && strlen( $answer ) || is_array( $answer ) || ! is_null( $answer ) ) {
            echo '<div class="question">' .
                $question .
                '</div>' .
                $answer .
                '<br>';
        }
        echo '</tr>' .
            '<tr>';
        if ( get_field('author') ) {
            echo '<div class="author">' .
                'Author: ' .
                $author .
                '</div>';
        } else {
            echo '<div class="author">' .
                'Author: ' .
                get_the_author_meta('display_name') .
                '</div>';
        }
        echo '</tr>' .
            '</td>' .
            '</table>' .
            '</div>';
    }
}
echo '</div>';
} );
} );

function create_posttype() {

    function category() {
        // create a new taxonomy
        register_taxonomy(
            'category',
            'faq',
            array(
                'label' => __( 'category' ),
                'rewrite' => array( 'slug' => 'categories' ),
                'capabilities' => array(
                    'assign_terms' => 'edit_guides',
                    'edit_terms' => 'publish_guides'
                )
            )
        );
    }
    add_action( 'init', 'category' );

    register_post_type( 'faq',
        array(
            'labels'      => array(
                'name'              => __( 'FAQ' ),
                'singular_name'     => __( 'FAQ' ),
                'add_new'           => __( 'Add new FAQ' ),
                'all_items'         => __( 'Overview' ),
                'view_item'         => __( 'View FAQs' ),
                'search_items'      => __( 'Looking for' ),
                'supports'          => array( 'title', 'editor', 'thumbnail' ),
                'texonomies'        => array('category'),
            ),
            'public'      => true,
            'has_archive' => true,
            'rewrite'     => array( 'slug' => 'faq' ),
        )
    );
}

add_action( 'init', 'create_posttype' );


if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5ea922b5c5d52',
        'title' => 'FAQ',
        'fields' => array(
            array(
                'key' => 'field_5ea92305514e5',
                'label' => 'Question',
                'name' => 'question',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5ea92383514e6',
                'label' => 'answer',
                'name' => 'answer',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5ea9239c514e7',
                'label' => 'Author',
                'name' => 'author',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;

