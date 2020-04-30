
<?php

add_action( 'init', function () {
    remove_post_type_support( 'faq', 'editor' );
    add_shortcode( 'faq', function ( $atts ) {

        $args = array(
            'post_type'             => 'faq',
            'posts_per_page'        => '50',
            'order_by'              => 'date',
            'order'                 => 'ASC',
        );

        echo '<h1 class="title">FAQs</h1>'.
            '<div class="flex-container">';

        $new_query = new WP_Query ( $args );
        if ( $new_query->have_posts() ) {
            while ( $new_query->have_posts() ) {
                $new_query->the_post();
                $question       = get_field( "question" );
                $answer         = get_field( "answer" );
                $author         = get_field( "author" );


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
                if ( has_post_thumbnail() ) {
                    echo '<div class="thumbnail">';
                    the_post_thumbnail( 'thumbnail' );
                    echo '</div>';
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
/*
add_shortcode( 'faqs', 'post_type' => 'faq','category_name' => 'faq-category', function ( $atts ) {

    echo 'Test';

}



$args = array( 'posts_per_page'=>-1,'post_type' => 'faq','category_name' => 'faq-category' );
$allposts= get_posts( $args );
if ($allposts) {
    foreach ( $allposts as $post ) {
        setup_postdata($post);
        ?>
        <div class="post_li">
            <h3><?php the_title(); ?></h3>
            <p><?php  ?></p>
            <?php $catename= get_the_terms(get_the_ID(),array('country'));
            foreach ( $catename as $term ) {
                $term_link = get_term_link( $term, array( 'country') );

                ?>
                <a>"><?php echo $term->name ?></a>
                <?php
            }
            ?>
        </div>
        <?php
    }
}
?>
