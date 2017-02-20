<?php 

$words = preg_split('//', 'abcdefghijklmnopqrstuvwxyz0123456789', -1);
shuffle($words);
foreach($words as $word) {
    echo $word . '<br />';
}

?>