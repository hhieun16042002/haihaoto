<?php
require_once '/var/www/html/wp-load.php';
$posts = get_posts([
    'category' => 130,
    'numberposts' => -1,
    'post_status' => 'any'
]);
echo "COUNT: " . count($posts) . "\n";
foreach ($posts as $p) {
    echo "ID: {$p->ID} | SLUG: {$p->post_name} | TITLE: {$p->post_title}\n";
}
