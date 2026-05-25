<?php

include 'db.php';

$data_items = $db->query("SELECT DISTINCT name, item_slot_type, cost, shop_image_webp FROM item_filters ORDER BY cost ASC, item_slot_type DESC;") or die($db->error);

while($row = $data_items->fetch_assoc()){

    if (!empty($_GET['tags']) ) {
        echo "<div class='item' tabindex='0'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
    }
    else {
        echo "<div class='item' tabindex='0'><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
    }

}

?>