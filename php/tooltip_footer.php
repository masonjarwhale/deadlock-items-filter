<?php

include 'db.php';
$class_name = $_POST['class_name'];
$class_name = "'".$class_name."'";

$upgrades_to = $db->query("SELECT distinct name, shop_image_webp FROM item_filters where class_name in (SELECT class_name from components_tofrom where component_items = $class_name)");
if (mysqli_num_rows($upgrades_to) !== 0) {
    echo "<div class='component-title'>UPGRADES TO:</div>";
    while($row = $upgrades_to->fetch_assoc()){
        echo "<div class='tooltip-img'><image src=\"{$row['shop_image_webp']}\"></image><div class='component-text'>{$row['name']}</div></div>";
    }
}

$upgrades_from = $db->query("SELECT distinct name, shop_image_webp FROM item_filters where class_name in (SELECT component_items from components_tofrom where class_name = $class_name)");
if (mysqli_num_rows($upgrades_from) !== 0) {
    echo "<div class='component-title'>UPGRADES FROM:</div>";
    while($row = $upgrades_from->fetch_assoc()){
        echo "<div class='tooltip-img'><image src=\"{$row['shop_image_webp']}\"></image><div class='component-text'>{$row['name']}</div></div>";
    }
}