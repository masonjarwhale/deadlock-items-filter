<?php

include 'db.php';
$class_name = $_POST['class_name'];
$class_name = "'".$class_name."'";

$data = $db->query("SELECT name, cost from item_filters where class_name = $class_name LIMIT 1");

while($row = $data->fetch_assoc()){
    echo "{$row['name']}<br>";
    echo "<div class='header-img'><image src='./icons/icon_soul.svg'></image><div class='component-text'>{$row['cost']}</div></div>";
}
