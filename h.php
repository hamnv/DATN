<?php
// See the password_hash() example to see where this came from.
$hash = '$2y$07$BCryptRequires22Chrcte/VlQH0piJtjXl.0t1XkA8pw9dMXTpOq';
$str1 = 'ham';
$str2 = password_hash($str1,3);
$str3 = 'ham';
$str4 =  'ddd';

if (password_verify($str3, $str2)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
?>