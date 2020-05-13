<?php

add_action( 'wp_head', function() { ?>
  <style>

    body {
      line-height: unset !important;
    }

    .flex-container {
      display:   flex;
      flex-wrap: wrap;
      height:    auto;
    }

    svg, img, embed, object {
      display: initial !important;
    }

    .border {
      border: 10px solid transparent;

    }

    .flex-container > div {
      flex:       1 1 600px;
      margin:     0 10px 0 10px;
      text-align: center;
    }

    .entry-content > *:not(.alignwide):not(.alignfull):not(.alignleft):not(.alignright):not(.is-style-wide) {
      max-width: unset !important;
    }

    .border tr {
      border: 10px solid transparent;
    }

    .faqtitle {
      text-align: center;
      padding:    25px 0 50px 0;
    }

    .faqquestion {
      padding:     0 0 10px 0;
      font-size:   120%;
      font-weight: bold;
    }

    .faqthumbnail {
      padding: 30px 0 0 0;

    }

    .faqauthor {
      color:      grey;
      font-style: italic;
    }

  </style>

<?php } );