<?php
// Custom login page
add_action('login_enqueue_scripts', 'custom_login_page');

function custom_login_page()
{ ?>
  <style type="text/css">
    body.login {
      display: flex;
      flex-direction: column;
      background-color: #d9d1ca;
    }

    body #login {
      max-width: 500px;
      width: 80%;
    }

    body.login label,
    body.login a {
      font-family: 'Piech Sans', sans-serif;
      font-weight: 500;
    }

    body.login input {
      border-color: #28221b;
      outline: none;
      border-radius: 0;
      background: transparent !important;
    }

    body.login input:focus {
      border-color: #28221b;
      outline: none;
      box-shadow: none !important;
    }

    body.login #wp-submit {
      background: transparent;
      border: 1px solid #f14109;
      border-radius: 2.315rem;
      color: #f14109;
      display: inline-block;
      padding: 0.2rem 1.6rem;
      transition: all 0.3s ease-in-out;
    }

    body.login #wp-submit:hover {
      background: #f14109 !important;
      color: #d9d1ca;
    }

    body.login #login #loginform {
      background: #d9d1ca;
      border: 1px solid #28221b;
    }

    body.login #login_error {
      background-color: #d9d1ca;
      border-left-color: #f14109;
    }

    body.login #login-message {
      border-left: 4px solid #28221b;
      background-color: #d9d1ca;
    }

    body.login #login h1 a {
      background-image: url('data:image/svg+xml,<svg width="1319" height="167" viewBox="0 0 1319 167" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M257.192 133.094H91.672L63.4682 166.104H0L144.78 0.0184326H204.104L348.883 166.104H285.415L257.211 133.094H257.192ZM219.856 89.4887L180.658 43.6041H168.206L129.009 89.4887H219.856Z" fill="%2328221b"/><path d="M346.904 166.104V0.0184326H434.432L511.599 122.499H522.804L602.446 0.0184326H689.974V166.104H643.313V43.6232H630.458L550.182 166.104H484.22L406.017 43.6232H393.565V166.104H346.904Z" fill="%2328221b"/><path d="M957.569 0.0191553H1023.11L893.045 108.859L878.521 122.25V166.085H831.86V122.5L817.336 109.108L687.272 0H752.813L848.667 75.3696H863.671L957.549 0L957.569 0.0191553Z" fill="%2328221b"/><path d="M1258.62 107.977H1066.97V166.104H1020.31V0.0184326H1258.64C1297.44 0.0184326 1319 19.1195 1319 53.988C1319 88.8565 1297.44 107.958 1258.64 107.958L1258.62 107.977ZM1066.97 43.6232V64.3911H1256.97C1266.72 64.3911 1271.28 61.6897 1271.28 54.0071C1271.28 46.3246 1266.72 43.6232 1256.97 43.6232H1066.97Z" fill="%2328221b"/></svg>');
      background-repeat: no-repeat;
      background-size: contain;
      width: 250px;
      height: auto;
      margin-bottom: 20px;
    }

    body.login a {
      color: #28221b !important;
    }

    body.login a:hover {
      text-decoration: underline !important;
    }

    body.login #login #backtoblog {
      display: none;
    }
  </style>
<?php }



// Custom login header link

add_filter('login_headerurl', 'custom_loginlogo_url');

function custom_loginlogo_url($url)
{
  return home_url();
}
