<?php

include 'db.php';
$table = $_POST['table'];

if (!empty($_POST['search']) ) {
    $search = $_POST['search'];
    $search = "%$search%";

    /* execute query is necessary to avoid sql injection!!!!!!! */
    $data = $db->execute_query("SELECT filepath FROM (SELECT DISTINCT SUBSTRING_INDEX(graphic_name, '.', -2) AS graphic_name, filepath FROM $table) AS test WHERE filepath like ? GROUP BY graphic_name", [$search]);

    while($row = $data->fetch_assoc()){
        echo "<a href='{$row['filepath']}'><image class='graphic' src='{$row['filepath']}' loading='lazy'></image></a>";
    }
}
else {
    $data = $db->query("SELECT filepath FROM (SELECT DISTINCT SUBSTRING_INDEX(graphic_name, '.', -2) AS graphic_name, filepath FROM $table) AS test GROUP BY graphic_name") or die($db->error);
    while($row = $data->fetch_assoc()){
        echo "<a href='{$row['filepath']}'><image class='graphic' src='{$row['filepath']}' loading='lazy'></image></a>";
    }
}