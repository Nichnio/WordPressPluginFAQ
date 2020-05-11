<?php

add_action( 'wp_head', function () { ?>
    <style>

        body {
            line-height: unset !important;
        }
        
        .flex-container {
            display: flex;
            flex-wrap: wrap;
            height: auto;
        }

        svg, img, embed, object{
            display: initial !important;
        }

        .border {
            border: 10px solid transparent;

        }

        .flex-container > div {
            flex: 1 0 21%;
            width: 300px;
            margin: 0 10px 0 10px;
            text-align: center;
        }
        .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide){
            max-width: unset !important;
        }



        .border tr {
            border: 10px solid transparent;
        }

        h1.title {
            text-align: center;
            padding: 25px 0 50px 0;
        }

        div.question {
            padding: 0 0 10px 0;
            font-size: 120%;
            font-weight: bold;
        }

        div.thumbnail {
            padding: 30px 0 0 0;

        }

        div.author {
            color: grey;
            font-style: italic;
        }

    </style>

<?php });