<?php

include 'db.php';
$table = $_POST['table'];

if (!empty($_POST['search']) ) {
    $search = $_POST['search'];

    $data = $db->query("SELECT * FROM $table where filepath like '%$search%'") or die($db->error);
    while($row = $data->fetch_assoc()){
        echo "<a href='{$row['filepath']}'><image class='graphic' src='{$row['filepath']}'></image></a>";
    }
}
else {
    $data = $db->query("SELECT * FROM $table") or die($db->error);
    while($row = $data->fetch_assoc()){
        echo "<a href='{$row['filepath']}'><image class='graphic' src='{$row['filepath']}'></image></a>";
    }

}

$db->close();
?>