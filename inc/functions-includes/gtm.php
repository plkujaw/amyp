<?php 
// Insert Google Tag Manager scripts

function theme_google_tag_manager()
{ ?>

  <!-- Google Tag Manager -->

  <!-- GTM SCRIPT CODE GOES HERE -->

  <!-- End Google Tag Manager -->

<?php }
add_action('wp_head', 'theme_google_tag_manager');

function theme_google_tag_manager_no_script()
{ ?>
  <!-- Google Tag Manager (noscript) -->

  <!-- GTM NOSCRIPT CODE GOES HERE -->

  <!-- End Google Tag Manager (noscript) -->
<?php
}
add_action('wp_body_open', 'theme_google_tag_manager_no_script');