<?php
$social = get_field('social_accounts', 'option');
if ($social) {
  echo "<h4>SOCIAL</h4>";
  echo "<ul>";
  foreach ($social as $account) { ?>
    <li><a href="<?php echo esc_url($account['account']['url']) ?>" target="<?php echo $account['account']['target'] ?>"><?php echo $account['account']['title'] ?></a></li>
<?php }
  echo "</ul>";
}
