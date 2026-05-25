<?php
include 'db.php';

$data_tags = $db->query("SELECT * FROM tags") or die($db->error);

while($row = $data_tags->fetch_assoc()){
    echo "<div class='tag-unselected' tabindex='0'><image src=\"{$row['filepath']}\"></image></div>";
}

?>