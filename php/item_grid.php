<?php

include 'db.php';
$query = "SELECT DISTINCT name, class_name, item_slot_type, cost, shop_image_webp FROM item_filters where stat_value not in (0,-1) and ";
$query_end = " ORDER BY cost ASC, item_slot_type DESC, name ASC";



if (!empty($_POST['tags']) ) {
    /* echo "yes";
    echo $_POST['tags'][0]; */
    $selected_tags_file_names = $_POST['tags'];

    $selected_tags_file_names = array_map(function($file_name) {
        return "'" . addslashes($file_name) . "'";
    }, $selected_tags_file_names);

    $sql_search = implode(',', $selected_tags_file_names);

    $selected_tag_data = $db->query("SELECT subquery FROM tags WHERE file_name IN ($sql_search)") or die($db->error);
    $next_row = $selected_tag_data->fetch_assoc();
    while($next_row !== null) {
        $current_row = $next_row;
        $next_row = $selected_tag_data->fetch_assoc();
        $last = ($next_row === null);
        if (!$last) {
            $query .= $current_row['subquery'];
            $query .= ' and ';
        }
        else {
            $query .= $current_row['subquery'];
        }
        
    }

    $query .= $query_end;
    /* echo $query; */

    $data_items = $db->query($query) or die($db->error);
    while($row = $data_items->fetch_assoc()){
        echo "<div class='item' tabindex='0' item-name=\"{$row['class_name']}\"><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
    }
}
else {
    /* echo "no post tags"; */
    $data_items = $db->query("SELECT DISTINCT name, class_name, item_slot_type, cost, shop_image_webp FROM item_filters ORDER BY cost ASC, item_slot_type DESC, name ASC") or die($db->error);
    while($row = $data_items->fetch_assoc()){
        echo "<div class='item' tabindex='0' item-name=\"{$row['class_name']}\"><image src=\"{$row['shop_image_webp']}\"></image><div class='item-name'>{$row['name']}</div></div>";
    }
}