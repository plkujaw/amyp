<?php
$address = get_field('address', 'option');
if ($address) {
  echo "<h4>" . $address[0]['address_line'] . "</h4>";
  for ($i = 1; $i < count($address); $i++) {
    echo "<p>" . $address[$i]['address_line'] . "</p>";
  }
}
