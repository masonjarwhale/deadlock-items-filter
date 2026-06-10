<?php
include 'db.php';

$data_tags = $db->query("SELECT * FROM tags") or die($db->error);

while($row = $data_tags->fetch_assoc()){
    echo "<div class='tag-unselected' tabindex='0' title=\"{$row['display_name']}\" tag=\"{$row['file_name']}\"><image src=\"{$row['filepath']}\"></image></div>";
}