<?php
include 'function.php';

add_action( 'init', function () {
    remove_post_type_support( 'faq', 'editor' );
    add_shortcode( 'faq', function ( $atts ) {

        $args = array(
            'post_type'      => 'faq', // Custom post type Name
            'order_by'       => 'date', // How to Order. date
            'order'          => 'ASC', // Ascending
            'nopaging'       => true,
        );

        faq_title();

        $new_query = new WP_Query ( $args );
        if ( $new_query->have_posts() ) { // If there are Posts
            while ( $new_query->have_posts() ) { // While there are Posts
                $new_query->the_post();
                $question   = get_field( "question" );
                $answer    = get_field( "answer" );
                $author     = get_field( "author" );

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

                faq_thumbnail();

                echo '</tr>' .
                    '<tr>';

                faq_author($author);

                echo '</tr>' .
                    '</td>' .
                    '</table>' .
                    '</div>';

            }
        }
        echo '</div>';
    } );
} );

order_notification();
