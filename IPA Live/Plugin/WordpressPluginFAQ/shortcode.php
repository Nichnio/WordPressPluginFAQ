<?php
// include CSS
include 'css.php';
// include the functions
include 'function.php';


add_action( 'init', function() {

    //shortcode for all faqs
    add_shortcode( 'faq', function() {

        $args = [

            'post_type' => 'faq',
            'order_by'  => 'date',
            'order'     => 'asc',

        ];
        // if there are faqs
        $new_posts = new WP_Query ( $args );

        if ( $new_posts->have_posts() ) {

            // if polylang is installed let the language change
            change_lang();

            // show FAQ as title
            faq_title();

            // While there are faqs
            while ( $new_posts->have_posts() ) {
                $new_posts->the_post();

                // show faqs in table
                faq_table();

            }
        }
    } );
} );

// Shortcodem for categorys
function shortcode_faq( $atts ) {

    $posts_per_page = -1;
    $category       = '';

    // assign values to variables
    extract( shortcode_atts( [
        'posts_per_page' => -1,
        'category' => '',
    ], $atts ) );

    $args = [
        'orderby'        => 'post_date',
        'posts_per_page' => $posts_per_page,
        'post_type'        => 'faq',
        'tax_query' => [
            'relation' => 'OR',
            [
                'taxonomy' => 'faq_kategorien',
                'field'    => 'slug',
                'terms'    => [ $category ],
            ],
        ],
    ];

    $new_posts = new WP_Query( $args );

    // if there are faqs
    if ( $new_posts->have_posts() ) {

        // if polylang is installed let the language change
        change_lang();

        // show FAQ as title
        faq_title();

        // While there are faqs
        while ( $new_posts->have_posts() ) {
            $new_posts->the_post();

            // show faqs in table
            faq_table();
        }
    }

}

add_shortcode( 'faq_kategorien', 'shortcode_faq' );

