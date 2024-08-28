<?php

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Theme
 * @since Theme 1.0
 */

/**
 * Clickjacking protection
 *
 * Add header to stop site loading in an iFrame.
 **/
function theme_headers()
{
  header('X-Frame-Options: SAMEORIGIN');
  header('X-UA-Compatible: IE=edge,chrome=1');
  header('Content-Security-Policy: frame-ancestors \'self\'  ;');
}
add_action('send_headers', 'theme_headers', 10);

// Add brand colours to Colour-Picker Pallettes in admin area
function klf_acf_input_admin_footer()
{ ?>
  <script type="text/javascript">
    (function() {
      acf.add_filter('color_picker_args', function(args, $field) {
        // add the hexadecimal codes here for the colors you want to appear as swatches
        args.palettes = ['#000000', '#FFFFFF', '#002D5B', '#1F8649', '#EF3742', '#F4D3D6']
        // return colors
        return args;
      });
    })();
  </script>
<?php }

add_action('acf/input/admin_footer', 'klf_acf_input_admin_footer');

// Disable Notification Emails for Plugin Updates
add_filter('auto_plugin_update_send_email', '__return_false');

// Disable ACF custom post type and taxonomies registration

add_filter('acf/settings/enable_post_types', '__return_false');

// add_filter('big_image_size_threshold', '__return_false');

function get_page_title()
{
  if (is_post_type_archive('project')) {
    $page_title = 'Portfolio';
  } elseif (is_category()) {
    $page_title = single_cat_title('', false);
  } elseif (is_home()) {
    $page_title = 'News';
  } else {
    $page_title = get_the_title();
  }
  return $page_title;
}
function current_paged($var = '')
{
  if (empty($var)) {
    global $wp_query;
    if (!isset($wp_query->max_num_pages))
      return;
    $pages = $wp_query->max_num_pages;
  } else {
    global $$var;
    if (!is_a($$var, 'WP_Query'))
      return;
    if (!isset($$var->max_num_pages) || !isset($$var))
      return;
    $pages = absint($$var->max_num_pages);
  }
  if ($pages < 1)
    return;
  $page = get_query_var('paged') ? get_query_var('paged') : 1;
  return  "<span class='current-page'>" . sprintf('%01d', $page) . "</span>" . "<span class='total-pages'>"  . '/' . sprintf('%02d', $pages) . "</span>";
}

// hide Page Attributes meta box from Pages
function remove_page_attribute_meta_box()
{
  remove_meta_box('pageparentdiv', 'page', 'normal');
}

// add_action('admin_menu', 'remove_page_attribute_meta_box');


function get_cat_link($cats)
{
  if (!empty($cats)) {
    $cats_array = [];
    foreach ($cats as $cat) {
      $cat_id = $cat->term_id;
      $cat_name = $cat->name;
      $cat_link = get_category_link($cat_id);
      $cats_array[] .= '<a href="' . get_category_link($cat_id) . '" class="post-cat fs-label">' . $cat_name . '</a>';
    }
  }
  return $cats_output = (!empty($cats_array)) ? ' ' . join(', ', $cats_array) : '';
}


function get_date()
{
  return $date = sprintf(
    '<time class="entry-date" datetime="%1$s">%2$s</time>',
    esc_attr(get_the_date('c')),
    esc_html(get_the_date())
  );
}

function get_share_links()
{
  $post_title = htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
  $post_url = urlencode(get_permalink());

  $twitter_share_url = 'https://twitter.com/intent/tweet?text=' . $post_title . '&amp;url=' . $post_url;

  $facebook_share_url = 'https://www.facebook.com/sharer/sharer.php?u=' . $post_url . '&t=' . $post_title;

  $linkedin_share_url = 'https://www.linkedin.com/sharing/share-offsite/?url=' . $post_url;

  $copy_share_url = 'javascript:void(0)';

  $links = [
    $facebook = (object)[
      'name' => 'facebook',
      'link' => $facebook_share_url,
      'icon' =>  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_190_5165)"> <path d="M29.1481 20.0741C29.1481 15.0626 25.0855 11 20.0741 11C15.0626 11 11 15.0626 11 20.0741C11 24.6031 14.3182 28.3572 18.6562 29.0379V22.697H16.3523V20.0741H18.6562V18.0749C18.6562 15.8008 20.011 14.5446 22.0837 14.5446C23.0761 14.5446 24.1149 14.7218 24.1149 14.7218V16.9549H22.9707C21.8435 16.9549 21.4919 17.6544 21.4919 18.3727V20.0741H24.0085L23.6062 22.697H21.4919V29.0379C25.8299 28.3572 29.1481 24.6031 29.1481 20.0741Z" fill="#F14109" /></g><rect x="39.5" y="0.5" width="39" height="39" rx="19.5" transform="rotate(90 39.5 0.5)" stroke="#F14109" />  <defs>    <clipPath id="clip0_190_5165">      <rect width="18.1481" height="18.1481" fill="white" transform="translate(11 11)" />    </clipPath>  </defs></svg>',
    ],
    $twitter = (object)[
      'name' => 'twitter',
      'link' => $twitter_share_url,
      'icon' =>  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M17.2709 28.3333C24.8039 28.3333 28.9259 22.0476 28.9259 16.6058C28.9259 16.429 28.9259 16.2521 28.9179 16.0753C29.7168 15.4966 30.4118 14.7651 30.963 13.9372C30.228 14.2667 29.4372 14.4838 28.6064 14.5883C29.4532 14.0819 30.1002 13.27 30.4118 12.3054C29.6209 12.7797 28.7422 13.1173 27.8076 13.3022C27.0566 12.4984 25.9942 12 24.8199 12C22.5592 12 20.7219 13.8488 20.7219 16.1235C20.7219 16.445 20.7618 16.7585 20.8257 17.064C17.4227 16.8952 14.403 15.2474 12.382 12.7556C12.0305 13.3665 11.8308 14.0738 11.8308 14.8294C11.8308 16.2602 12.5577 17.5221 13.6521 18.2616C12.9811 18.2375 12.35 18.0527 11.7988 17.7472C11.7988 17.7633 11.7988 17.7794 11.7988 17.8035C11.7988 19.7969 13.2128 21.4688 15.0821 21.8466C14.7386 21.9431 14.3791 21.9913 14.0036 21.9913C13.74 21.9913 13.4844 21.9672 13.2367 21.919C13.756 23.5587 15.2738 24.7484 17.0632 24.7805C15.6572 25.8898 13.8918 26.5489 11.9746 26.5489C11.6471 26.5489 11.3195 26.5328 11 26.4926C12.8054 27.6501 14.9622 28.3333 17.2709 28.3333Z" fill="#F14109" />  <rect x="39.5" y="0.5" width="39" height="39" rx="19.5" transform="rotate(90 39.5 0.5)" stroke="#F14109" /></svg>',
    ],
    $linkedin = (object)[
      'name' => 'linkedin',
      'link' => $linkedin_share_url,
      'icon' => '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">  <g clip-path="url(#clip0_190_5173)">    <path d="M27.1243 12H13.2059C12.5391 12 12 12.5264 12 13.1771V27.153C12 27.8038 12.5391 28.3333 13.2059 28.3333H27.1243C27.791 28.3333 28.3333 27.8038 28.3333 27.1562V13.1771C28.3333 12.5264 27.791 12 27.1243 12ZM16.8458 25.9184H14.4213V18.1218H16.8458V25.9184ZM15.6335 17.0595C14.8551 17.0595 14.2267 16.4311 14.2267 15.6559C14.2267 14.8807 14.8551 14.2522 15.6335 14.2522C16.4087 14.2522 17.0372 14.8807 17.0372 15.6559C17.0372 16.4279 16.4087 17.0595 15.6335 17.0595ZM25.9184 25.9184H23.4971V22.1286C23.4971 21.2258 23.4812 20.0614 22.237 20.0614C20.977 20.0614 20.7855 21.0471 20.7855 22.0648V25.9184H18.3674V18.1218H20.6898V19.1873H20.7217C21.0439 18.5748 21.8351 17.9272 23.0122 17.9272C25.4654 17.9272 25.9184 19.5414 25.9184 21.6405V25.9184Z" fill="#F14109" /></g>  <rect x="39.5" y="0.5" width="39" height="39" rx="19.5" transform="rotate(90 39.5 0.5)" stroke="#F14109" />  <defs>    <clipPath id="clip0_190_5173">      <rect width="16.3333" height="16.3333" fill="white" transform="translate(12 12)" />    </clipPath>  </defs></svg>',

    ],
    $copy = (object)[
      'name' => 'copy',
      'link' => $copy_share_url,
      'icon' =>  '<svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg"> <path fill-rule="evenodd" clip-rule="evenodd" d="M24.6403 12.1874C23.6063 12.2349 22.6121 12.6663 21.8434 13.4011L18.8284 16.2835C19.302 15.8284 21.0599 16.1413 21.4864 16.549L23.3113 14.8044C23.7154 14.418 24.2213 14.181 24.7395 14.1596C25.0915 14.143 25.5899 14.2142 26.0288 14.6337C26.4379 15.0248 26.5247 15.48 26.5247 15.7905C26.5247 16.3096 26.2767 16.8264 25.8503 17.2317L22.6765 20.2848C21.8782 21.0481 20.6632 21.1097 19.959 20.4365C19.5574 20.0525 18.8954 20.0501 18.4912 20.4365C18.0871 20.8229 18.0871 21.4534 18.4912 21.8398C19.2152 22.5319 20.1673 22.8828 21.1492 22.8828C22.2104 22.8828 23.2939 22.4679 24.1246 21.6691L27.3181 18.635C28.1289 17.8622 28.5876 16.8287 28.5876 15.7905C28.5876 14.8257 28.2058 13.9084 27.4966 13.2304C26.7379 12.5051 25.7189 12.14 24.6403 12.1874ZM19.7206 17.08C18.6594 17.08 17.5585 17.4972 16.7254 18.2937L13.5517 21.3278C12.7409 22.1005 12.2822 23.1341 12.2822 24.1723C12.2822 25.1371 12.6641 26.0544 13.3732 26.7323C14.1319 27.4577 15.151 27.8227 16.2295 27.7753C17.2635 27.7279 18.2577 27.2965 19.0264 26.5617L22.0414 23.6792C21.5654 24.1344 19.8099 23.8215 19.3834 23.4138L17.5585 25.1584C17.1544 25.5448 16.6486 25.7794 16.1304 25.8031C15.7783 25.8197 15.2799 25.7486 14.841 25.3291C14.4319 24.9379 14.3451 24.4804 14.3451 24.1723C14.3451 23.6532 14.5931 23.1364 15.0196 22.7311L18.1933 19.678C18.9917 18.9147 20.2066 18.8554 20.9108 19.5263C21.3149 19.9127 21.9769 19.9127 22.3786 19.5263C22.7828 19.1399 22.7828 18.5094 22.3786 18.123C21.6546 17.4308 20.7 17.08 19.7206 17.08Z" fill="#F14109" /> <rect x="39.5" y="0.5" width="39" height="39" rx="19.5" transform="rotate(90 39.5 0.5)" stroke="#F14109" /></svg>',
    ],
  ];

  // for each link in links, create a link with url and icon
  $links_array = [];
  foreach ($links as $link) {
    $links_array[] .= '<li><a href="' . $link->link . '" class="share-link slide-in js-slide-in" id="share-' . $link->name . '"target="_blank">' . $link->icon . '</a></li>';
  }

  return $cats_output = (!empty($links_array)) ? ' ' . join('', $links_array) : '';
}


// Add class to links generated by next_posts_link and previous_posts_link

// add_filter('next_posts_link_attributes', 'posts_link_attributes');
// add_filter('previous_posts_link_attributes', 'posts_link_attributes');

// function posts_link_attributes()
// {
//   return 'class="styled-button"';
// }